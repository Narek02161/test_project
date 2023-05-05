<?php

namespace App\Models\Statement;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Services\Statement\Dto\UpdateStatementDTO;
use App\Services\Statement\Dto\CreateStatementDTO;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $user_id
 * @property string $title
 * @property string|null $source_url
 * @property string|null $description
 * @property string $author_name
 * @property mixed|null $is_published
 * @property string|null $source_title
 * @property string $date_published
 * @property mixed $id
 * @property int $owner_id
 * @property-read $userStatement
 */
class Statement extends Model
{
    use HasFactory;

    protected $table = 'statements';

    protected $fillable = [
        'title',
        'author_name',
        'owner_id',
        'description',
        'date_published',
        'source_url',
        'source_title',
        'is_published',
    ];

    public static function create(CreateStatementDTO $dto): Statement
    {
        $statement = new self();

        $statement->setTitle($dto->title);
        $statement->setOwnerId($dto->userId);
        $statement->setSourceUrl($dto->sourceUrl);
        $statement->setDescription($dto->description);
        $statement->setAuthorName($dto->authorName);
        $statement->setIsPublished($dto->isPublished);
        $statement->setSourceTitle($dto->sourceTitle);
        $statement->setDatePublished($dto->datePublished);

        return $statement;
    }

    public function updateByUser(UpdateStatementDTO $dto): Statement
    {
        $this->setTitle($dto->title);
        $this->setSourceUrl($dto->sourceUrl);
        $this->setAuthorName($dto->authorName);
        $this->setDescription($dto->description);
        $this->setSourceTitle($dto->sourceTitle);
        $this->setIsPublished($dto->isPublished);
        $this->setDatePublished($dto->datePublished);

        return $this;
    }

    public function setOwnerId(int $userId): void
    {
        $this->owner_id = $userId;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setSourceUrl(?string $sourceUrl): void
    {
        $this->source_url = $sourceUrl;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function setAuthorName(string $authorName): void
    {
        $this->author_name = $authorName;
    }

    public function setIsPublished(?bool $isPublished): void
    {
        $this->is_published = $isPublished;
    }

    public function setSourceTitle(?string $sourceTitle): void
    {
        $this->source_title = $sourceTitle;
    }

    public function setDatePublished(string $datePublished): void
    {
        $this->date_published = $datePublished;
    }

    public function userStatement(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'user_statements',
            'statement_id',
            'user_id',
        );
    }
}
