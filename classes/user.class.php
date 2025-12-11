<?php
require_once(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/tools.class.php');
use Ramsey\Uuid\Uuid;
class User{
    private int $id;
    private string $public_id;
    private string $email;
    private string $full_name;
    private int $is_active;
    private ?DateTime $last_login;
    private DateTime $created_at;
    private DateTime $updated_at;

    /** Create a User object by fetching data from the database
     * @param $id int Internal row ID of the user
     * @throws Exception if user not found or multiple users found
     * @throws Exception if datetime fields are in invalid format
     */
    public function __construct(int $id){
        // Validate input
        if ($id <= 0) {
            throw new Exception("Invalid user identifier");
        }
        
        $db = Tools::getDB();
        $sql = "SELECT id, public_id, email, full_name, is_active, last_login, created_at, updated_at FROM users WHERE id = ?";
                $stmt = $db->prepare($sql);
        if (!$stmt) {
            throw new Exception('Database prepare failed: ' . $db->error);
        }
        $stmt->bind_param("i", $id);
        /** @var int $fetched_id */
        /** @var string $fetched_public_id */
        /** @var string $fetched_email */
        /** @var string $fetched_full_name */
        /** @var int $fetched_is_active */
        /** @var string|null $fetched_last_login */
        /** @var string $fetched_created_at */
        /** @var string $fetched_updated_at */
        $stmt->bind_result($fetched_id, $fetched_public_id, $fetched_email, $fetched_full_name, $fetched_is_active, $fetched_last_login, $fetched_created_at, $fetched_updated_at);
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

        $stmt->fetch();
        $this->id = $fetched_id;
        $this->public_id = Uuid::fromBytes($fetched_public_id)->toString();
        $this->email = $fetched_email;
        $this->full_name = $fetched_full_name;
        $this->is_active = $fetched_is_active;

        try {
            $this->last_login = $fetched_last_login ? new DateTime($fetched_last_login) : null;
        } catch (Exception $e) {
            throw new Exception("Invalid last_login datetime format: " . $e->getMessage());
        }

        try {
            $this->created_at = new DateTime($fetched_created_at);
        } catch (Exception $e) {
            throw new Exception("Invalid created_at datetime format: " . $e->getMessage());
        }

        try {
            $this->updated_at = new DateTime($fetched_updated_at);
        } catch (Exception $e) {
            throw new Exception("Invalid updated_at datetime format: " . $e->getMessage());
        }

        $stmt->close();
    }


    /** Get internal database ID - USE ONLY FOR INTERNAL OPERATIONS
     * For external APIs, URLs, or client exposure, use getPublicId() instead
     * @return int Internal database ID
     */
    public function getId(): int {
        return $this->id;
    }

    /** Get public UUID - USE FOR EXTERNAL EXPOSURE
     * Safe to expose in APIs, URLs, and client-side code
     * @return string UUID string representation
     */
    public function getPublicId(): string {
        return $this->public_id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getFullName(): string
    {
        return $this->full_name;
    }
    public function isActive(): bool{
                return $this->is_active === 1;
    }
    public function getLastLogin(): ?DateTime{
        return $this->last_login;
    }
    public function getCreatedAt(): DateTime{
        return $this->created_at;
    }
    public function getUpdatedAt(): DateTime{
        return $this->updated_at;
    }
}