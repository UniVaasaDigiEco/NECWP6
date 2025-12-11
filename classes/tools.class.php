<?php
require_once(__DIR__ . '/../config/constants.php');
require_once(__DIR__ . '/user.class.php');
require_once(__DIR__ . '/event.class.php');
require_once(__DIR__ . '/../vendor/autoload.php');
use Ramsey\Uuid\Uuid;
class Tools{
    public static function getDB(): mysqli
    {
        return new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }

    public static function sanitizeInput(string $input): string {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }

    /**
     * @throws Exception
     */
    public static function getUserWithPublicId(string $public_id): User {
        $db = self::getDB();
        $sql = "SELECT id FROM users WHERE public_id = ?";
        $stmt = $db->prepare($sql);
        $binary_public_id = Uuid::fromString($public_id)->getBytes();
        $stmt->bind_param("s", $binary_public_id);
        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows === 0) {
            $stmt->close();
            throw new Exception("User not found");
        }

        if($stmt->num_rows > 1) {
            $stmt->close();
            throw new Exception("Database integrity error");
        }
        /** @var int $fetched_id */
        $stmt->bind_result($fetched_id);
        $stmt->fetch();
        $stmt->close();

        return new User($fetched_id);
    }

    public static function showMessage(int $code): string {
        $message = MESSAGE_CODES[$code] ?? "Unknown message code.";
        return "<div id='loginAlert' class='alert alert-danger' role='alert'>
            <i class='bi bi-exclamation-triangle-fill me-2'></i>
            <span id='loginAlertMessage'>$message</span>
        </div>
        <script>
            // Remove error parameter from URL without page reload
            if (window.history.replaceState) {
                const url = new URL(window.location);
                url.searchParams.delete('error');
                window.history.replaceState({}, '', url);
            }
        </script>";
    }

    public static function generatePublicId(): string {
        $uuid = Uuid::uuid4();
        return $uuid->getBytes();
    }

    static function reArrayFiles($attachFile): array
    {
        $file_ary = array();
        $file_count = count($attachFile['name']);
        $file_keys = array_keys($attachFile);
        for ($i=0; $i<$file_count; $i++)
        {
            foreach ($file_keys as $key)
            {
                $file_ary[$i][$key] = $attachFile[$key][$i];
            }
        }
        return $file_ary;
    }

    // Function to sanitize filename
    static function sanitizeFileName($fileName): array|string|null
    {
        // Replace Scandic and special characters
        $replacements = [
            'å' => 'a', 'ä' => 'a', 'ö' => 'o',
            'Å' => 'A', 'Ä' => 'A', 'Ö' => 'O',
            'é' => 'e', 'É' => 'E',
            'ü' => 'u', 'Ü' => 'U',
            ' ' => '_'
        ];

        $sanitized = str_replace(array_keys($replacements), array_values($replacements), $fileName);

        // Remove any remaining non-ASCII characters and multiple underscores
        $sanitized = preg_replace('/[^A-Za-z0-9._-]/', '_', $sanitized);
        return preg_replace('/_+/', '_', $sanitized);
    }

    /** Get all events and return an array of Event objects
     * @return Event[]
     * @throws Exception
     */
    static function getEvents(): array
    {
        $events = [];

        $db = self::getDB();
        $sql = "SELECT id FROM events WHERE is_published = 1 ORDER BY event_date DESC, event_time DESC";
        $stmt = $db->prepare($sql);
        /**
         * @var int $event_id
         */
        $stmt->bind_result($event_id);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows > 0){
            while($stmt->fetch()){
                try{
                    $events[] = new Event($event_id);
                }
                catch(Exception $e){
                    // Log error but continue loading other events
                    error_log("Error loading event with ID $event_id: " . $e->getMessage());
                }
            }
        }
        $stmt->close();
        return $events;
    }

    /**
     * @throws Exception
     */
    static function getEventWithPublicId(string $public_id): Event
    {
        $db = self::getDB();
        $sql = "SELECT id FROM events WHERE public_id = ?";
        $stmt = $db->prepare($sql);
        $binary_public_id = Uuid::fromString($public_id)->getBytes();
        $stmt->bind_param("s", $binary_public_id);
        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows === 0) {
            $stmt->close();
            throw new Exception("Event not found");
        }

        if($stmt->num_rows > 1) {
            $stmt->close();
            throw new Exception("Database integrity error");
        }
        /** @var int $fetched_id */
        $stmt->bind_result($fetched_id);
        $stmt->fetch();
        $stmt->close();

        return new Event($fetched_id);
    }
}