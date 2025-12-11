<?php
require_once(__DIR__ . '/../../config/constants.php');
require_once(__DIR__ . '/../../classes/security.class.php');

// Start session and protect this page
session_name(SESSION_NAME);
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Require authentication - will redirect to login page if not authenticated
Security::requireAuth('../login.php');
?>
<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel - InnoWind</title>
    <link rel="icon" type="image/x-icon" href="../../favicon.ico">
    <link rel="stylesheet" href="../../css/bs-custom.css">
    <link rel="stylesheet" href="../../node_modules/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../node_modules/summernote/dist/summernote-bs5.css">
    <link rel="stylesheet" href="../../node_modules/flatpickr/dist/flatpickr.min.css">
    <style>
        .image-browser-item {
            cursor: pointer;
            border: 3px solid transparent;
            transition: all 0.2s;
            border-radius: 0.5rem;
            overflow: hidden;
        }
        .image-browser-item:hover {
            border-color: #0d6efd;
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        .image-browser-item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }
        .image-browser-item .card-body {
            background-color: #f8f9fa;
        }
        #image-browser-grid {
            max-height: 60vh;
            overflow-y: auto;
        }
    </style>
    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../node_modules/summernote/dist/summernote-bs5.js"></script>
    <script src="../../node_modules/flatpickr/dist/flatpickr.min.js"></script>
    <script>
        $(function(){
            // Variable to track current editor for image browser
            let currentEditor = null;

            // Function to handle image upload for Summernote
            function uploadSummernoteImage(file, editor) {
                let data = new FormData();
                data.append("file", file);

                $.ajax({
                    url: '../../actions/summernote_image_upload.php',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: data,
                    type: 'POST',
                    success: function(response) {
                        try {
                            let jsonResponse = typeof response === 'string' ? JSON.parse(response) : response;
                            if (jsonResponse.url) {
                                console.log(jsonResponse.url);
                                $(editor).summernote('insertImage', jsonResponse.url);
                            } else if (jsonResponse.error) {
                                alert('Error: ' + jsonResponse.error);
                            }
                        } catch (e) {
                            alert('Error uploading image. Please try again.');
                            console.error('Upload error:', e, response);
                        }
                    },
                    error: function(jqXHR, textStatus) {
                        alert('Error uploading image: ' + textStatus);
                        console.error('Upload error:', jqXHR.responseText);
                    }
                });
            }

            // Function to open image browser
            function openImageBrowser(editor) {
                currentEditor = editor;
                $('#modal-image-browser').modal('show');
                loadImages();
            }

            // Function to load images from server
            function loadImages() {
                $('#image-browser-grid').html('<div class="col-12 text-center py-4"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>');

                $.get('../../actions/get_summernote_images.php', function(response) {
                    let html = '';
                    if (response.images && response.images.length > 0) {
                        response.images.forEach(function(image) {
                            let fileSize = (image.size / 1024).toFixed(1) + ' KB';
                            let fileName = image.filename.length > 25 ? image.filename.substring(0, 22) + '...' : image.filename;
                            html += `
                                <div class="col-6 col-md-4 col-lg-3">
                                    <div class="image-browser-item card h-100" data-url="${image.url}">
                                        <img src="${image.url}" class="card-img-top" alt="${image.filename}">
                                        <div class="card-body p-2">
                                            <small class="text-muted d-block" title="${image.filename}">${fileName}</small>
                                            <small class="text-muted">${fileSize}</small>
                                        </div>
                                    </div>
                                </div>
                            `;
                        });
                    } else {
                        html = '<div class="col-12 text-center py-5"><p class="text-muted fs-5"><i class="bi bi-images"></i><br>No images uploaded yet.<br><small>Upload images by pasting or dragging them into the editor.</small></p></div>';
                    }
                    $('#image-browser-grid').html(html);

                    // Handle image selection
                    $('.image-browser-item').on('click', function() {
                        let imageUrl = $(this).data('url');
                        if (currentEditor) {
                            $(currentEditor).summernote('insertImage', imageUrl);
                        }
                        $('#modal-image-browser').modal('hide');
                    });
                }).fail(function() {
                    $('#image-browser-grid').html('<div class="col-12 text-center py-5"><p class="text-danger"><i class="bi bi-exclamation-triangle"></i><br>Error loading images.</p></div>');
                });
            }

            let toolbarConfig = [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'imageBrowser', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ];

            // Event, Summernote Init
            $('#editor-add-event').summernote({
                placeholder: 'Event description...',
                tabsize: 2,
                height: 300,
                width: '100%',
                toolbar: toolbarConfig,
                buttons: {
                    imageBrowser: function() {
                        let ui = $.summernote.ui;
                        let button = ui.button({
                            contents: '<i class="bi bi-images"/> Browse',
                            tooltip: 'Browse uploaded images',
                            click: function() {
                                openImageBrowser('#editor-add-event');
                            }
                        });
                        return button.render();
                    }
                },
                callbacks: {
                    onImageUpload: function(files){
                        for (let i = 0; i < files.length; i++) {
                            uploadSummernoteImage(files[i], this);
                        }
                    }
                }
            });

            //News, Summernote Init
            $('#editor-add-news-item').summernote({
                placeholder: 'News content...',
                tabsize: 2,
                height: 300,
                width: '100%',
                toolbar: toolbarConfig,
                buttons: {
                    imageBrowser: function() {
                        let ui = $.summernote.ui;
                        let button = ui.button({
                            contents: '<i class="bi bi-images"/> Browse',
                            tooltip: 'Browse uploaded images',
                            click: function() {
                                openImageBrowser('#editor-add-news-item');
                            }
                        });
                        return button.render();
                    }
                },
                callbacks: {
                    onImageUpload: function(files){
                        for (let i = 0; i < files.length; i++) {
                            uploadSummernoteImage(files[i], this);
                        }
                    }
                }
            });

            //Article, Summernote Init
            $('#editor-add-article').summernote({
                placeholder: 'Article description...',
                tabsize: 2,
                height: 300,
                width: '100%',
                toolbar: toolbarConfig,
                buttons: {
                    imageBrowser: function() {
                        let ui = $.summernote.ui;
                        let button = ui.button({
                            contents: '<i class="bi bi-images"/> Browse',
                            tooltip: 'Browse uploaded images',
                            click: function() {
                                openImageBrowser('#editor-add-article');
                            }
                        });
                        return button.render();
                    }
                },
                callbacks: {
                    onImageUpload: function(files){
                        for (let i = 0; i < files.length; i++) {
                            uploadSummernoteImage(files[i], this);
                        }
                    }
                }
            });

            // Initialize Flatpickr for date/time input with Finnish format
            flatpickr("#event-date", {
                enableTime: true,
                time_24hr: true,
                dateFormat: "d.m.Y H:i",
                altInput: true,
                altFormat: "d.m.Y H:i",
                defaultDate: new Date(),
                locale: {
                    firstDayOfWeek: 1 // Monday
                }
            });

            flatpickr("#article-publication-date", {
                dateFormat: "Y-m-d",
                altInput: true,
                altFormat: "d.m.Y",
                locale: {
                    firstDayOfWeek: 1 // Monday
                }
            });

            $('#btn-add-new-event').on('click', function(){
                addNewEvent();
            });

            $('#btn-add-news-item').on('click', function(){
                addNewNewsItem();
            });

            $('#btn-add-article').on('click', function(){
                addNewArticle();
            });
        });

        function addNewEvent(){
            let data = {
                title: $('#event-title').val(),
                description: $('#event-description').val(),
                event_date: $('#event-date').val(),
                content: $('#editor-add-event').summernote('code'),
                user_id: '<?php echo $_SESSION['user_id']; ?>'
            };

            $.post('../../actions/add_new_event.php', data, function(response){
                // Handle response
                alert(response);
                // Close modal
                $('#modal-add-event').modal('hide');
                // Optionally, refresh the page or update the event list
            }).fail(function(){
                alert('Error adding event. Please try again.');
            });
        }

        function addNewNewsItem(){
            let data = {
                headline: $('#news-headline').val(),
                content: $('#editor-add-news-item').summernote('code'),
                user_id: '<?php echo $_SESSION['user_id']; ?>'
            };

            $.post('../../actions/add_new_news_item.php', data, function(response){
                // Handle response
                alert(response);
                // Close modal
                $('#modal-add-news').modal('hide');
                // Optionally, refresh the page or update the news list
            }).fail(function(){
                alert('Error adding news item. Please try again.');
            });
        }

        function addNewArticle(){
            let user_id = '<?php echo $_SESSION['user_id']; ?>';
            let title = $('#article-title').val();
            let authors = $('#article-authors').val();
            let publication_date = $('#article-publication-date').val();
            let description = $('#editor-add-article').summernote('code');

            let formData = new FormData();
            formData.append('user_id', user_id);
            formData.append('article_title', title);
            formData.append('article_authors', authors);
            formData.append('article_publication_date', publication_date);
            formData.append('description', description);

            let files = $('#article-file')[0].files;
            for (let i = 0; i < files.length; i++) {
                formData.append('article_file[]', files[i]);
            }

            $.ajax({
                url: '../../actions/add_new_article.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response){
                    // Handle response
                    console.log(response);
                    // Close modal
                    $('#modal-add-article').modal('hide');
                    // Optionally, refresh the page or update the article list
                },
                error: function(){
                    alert('Error adding article. Please try again.');
                }
            });
        }
    </script>
</head>
<body class="bg-secondary-subtle">
    <!-- Modals -->
    <div id="modal-add-event" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add a new event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="title-input-add-event" class="mb-3">
                        <label for="event-title" class="form-label">Event Title:</label>
                        <input type="text" id="event-title" name="event-title" class="form-control" placeholder="Enter event title">
                    </div>
                    <div id="description-input-add-event" class="mb-3">
                        <label for="event-description" class="form-label">Description:</label>
                        <textarea id="event-description" name="event-description" class="form-control" rows="4" placeholder="Brief description of the event" required></textarea>
                        <small class="form-text text-muted">Short summary of the event</small>
                    </div>
                    <div id="date-input-add-event" class="mb-3">
                        <label for="event-date" class="form-label">Event Date & Time:</label>
                        <input type="text" id="event-date" name="event-date" class="form-control mb-3" placeholder="DD.MM.YYYY HH:mm" value="">
                    </div>
                    <div id="editor-add-event">Add your content here. Use the "Full Screen" button to check, that your layout looks good and functions as it should</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Cancel"><i class="bi bi-x-circle-fill"></i> Cancel</button>
                    <button id="btn-add-new-event" type="button" class="btn btn-success"><i class="bi bi-floppy-fill"></i> Save</button>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-add-news" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add a news item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="title-input-add-event" class="mb-3">
                        <label for="news-headline" class="form-label">Headline: </label>
                        <input type="text" id="news-headline" name="news-headline" class="form-control" placeholder="Enter a headline">
                    </div>
                    <div id="editor-add-news-item">Add your content here. Use the "Full Screen" button to check, that your layout looks good and functions as it should</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Cancel"><i class="bi bi-x-circle-fill"></i> Cancel</button>
                    <button id="btn-add-news-item" type="button" class="btn btn-success"><i class="bi bi-floppy-fill"></i> Save</button>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-add-article" class="modal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add an Article</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                    <div class="mb-3">
                        <label for="article-title" class="form-label">Title: <span class="text-danger">*</span></label>
                        <input type="text" id="article-title" name="article_title" class="form-control" placeholder="Enter article title" required>
                    </div>
                    <div class="mb-3">
                        <label for="article-authors" class="form-label">Authors: <span class="text-danger">*</span></label>
                        <input type="text" id="article-authors" name="article_authors" class="form-control" placeholder="e.g., John Doe, Jane Smith" required>
                        <small class="form-text text-muted">Separate multiple authors with commas</small>
                    </div>
                    <div class="mb-3">
                        <label for="article-file" class="form-label">Article File (PDF/DOC/DOCX):</label>
                        <input type="file" id="article-file" name="article_file[]" class="form-control" multiple>
                        <small class="form-text text-muted">Upload the article document (optional)</small>
                    </div>
                    <div class="mb-3">
                        <label for="article-publication-date" class="form-label">Publication Date:</label>
                        <input type="text" id="article-publication-date" name="article_publication_date" class="form-control" placeholder="DD.MM.YYYY">
                        <small class="form-text text-muted">Original publication date (optional)</small>
                    </div>
                    <div class="mb-3">
                        <label for="editor-add-article" class="form-label">Description/Abstract: <span class="text-danger">*</span></label>
                        <div id="editor-add-article">Add your content here. Use the "Full Screen" button to check, that your layout looks good and functions as it should</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Cancel"><i class="bi bi-x-circle-fill"></i> Cancel</button>
                    <button id="btn-add-article" type="button" class="btn btn-success"><i class="bi bi-floppy-fill"></i> Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <header>
        <?php include_once '../../components/navbar.php'; ?>
    </header>
    <!-- Main content -->
    <main>
        <section id="headline">
            <div class="col-12 col-lg-8 offset-lg-2 px-4 pt-5 pb-3 text-center">
                <h1 class="display-4 fw-bold">InnoWind -admin</h1>
                <p class="lead fs-3 text-muted fw-semibold">Manage InnoWind site content.</p>
            </div>
        </section>
        <hr>
        <section id="content">
            <div class="row">
                <div class="col-12 col-lg-8 offset-lg-2 px-4 py-5">
                    <fieldset class="border border-black border-1 rounded-3 p-4 mb-4 shadow">
                        <legend>Add new item</legend>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-add-event"><i class="bi bi-plus-circle-fill"></i> Add a an event</button>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-add-news"><i class="bi bi-plus-circle-fill"></i> Add a news item</button>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-add-article"><i class="bi bi-plus-circle-fill"></i> Add an article</button>
                    </fieldset>
                </div>
            </div>
        </section>
    </main>

    <!-- Image Browser Modal -->
    <div id="modal-image-browser" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-images"></i> Select Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="image-browser-grid" class="row g-3">
                        <div class="col-12 text-center">
                            <div class="spinner-border" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Close</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
