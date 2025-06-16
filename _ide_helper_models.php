<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $slug
 * @property string|null $excerpt
 * @property string|null $featured_image
 * @property string $category
 * @property array<array-key, mixed>|null $tags
 * @property int|null $read_time_minutes
 * @property int $views
 * @property bool $is_published
 * @property int $author_id
 * @property \Illuminate\Support\Carbon|null $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $author
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article whereExcerpt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article whereFeaturedImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article whereIsPublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article whereReadTimeMinutes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article whereViews($value)
 */
	class Article extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $user_message
 * @property string $bot_response
 * @property string $conversation_type
 * @property array<array-key, mixed>|null $context
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChatbotConversation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChatbotConversation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChatbotConversation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChatbotConversation whereBotResponse($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChatbotConversation whereContext($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChatbotConversation whereConversationType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChatbotConversation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChatbotConversation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChatbotConversation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChatbotConversation whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ChatbotConversation whereUserMessage($value)
 */
	class ChatbotConversation extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $consultation_type
 * @property string $topic
 * @property string $description
 * @property numeric $price
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $scheduled_at
 * @property int $duration_minutes
 * @property string $payment_status
 * @property string|null $payment_method
 * @property string|null $consultant_notes
 * @property int|null $rating
 * @property string|null $review
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consultation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consultation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consultation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consultation whereConsultantNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consultation whereConsultationType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consultation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consultation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consultation whereDurationMinutes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consultation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consultation wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consultation wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consultation wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consultation whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consultation whereReview($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consultation whereScheduledAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consultation whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consultation whereTopic($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consultation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Consultation whereUserId($value)
 */
	class Consultation extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $youtube_url
 * @property string|null $thumbnail
 * @property string $category
 * @property string $level
 * @property int|null $duration_minutes
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course whereDurationMinutes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Course whereYoutubeUrl($value)
 */
	class Course extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $type
 * @property string $category
 * @property string $description
 * @property numeric $amount
 * @property \Illuminate\Support\Carbon $transaction_date
 * @property string|null $payment_method
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FinancialRecord newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FinancialRecord newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FinancialRecord query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FinancialRecord whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FinancialRecord whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FinancialRecord whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FinancialRecord whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FinancialRecord whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FinancialRecord whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FinancialRecord wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FinancialRecord whereTransactionDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FinancialRecord whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FinancialRecord whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|FinancialRecord whereUserId($value)
 */
	class FinancialRecord extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $category
 * @property string $difficulty
 * @property int|null $time_limit_minutes
 * @property int $passing_score
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\QuizAttempt> $attempts
 * @property-read int|null $attempts_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\QuizQuestion> $questions
 * @property-read int|null $questions_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Quiz newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Quiz newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Quiz query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Quiz whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Quiz whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Quiz whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Quiz whereDifficulty($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Quiz whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Quiz whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Quiz wherePassingScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Quiz whereTimeLimitMinutes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Quiz whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Quiz whereUpdatedAt($value)
 */
	class Quiz extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $quiz_id
 * @property array<array-key, mixed> $answers
 * @property int $score
 * @property int $total_questions
 * @property int $correct_answers
 * @property bool $is_passed
 * @property int|null $time_taken_seconds
 * @property \Illuminate\Support\Carbon|null $started_at
 * @property \Illuminate\Support\Carbon|null $completed_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Quiz $quiz
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizAttempt newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizAttempt newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizAttempt query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizAttempt whereAnswers($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizAttempt whereCompletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizAttempt whereCorrectAnswers($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizAttempt whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizAttempt whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizAttempt whereIsPassed($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizAttempt whereQuizId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizAttempt whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizAttempt whereStartedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizAttempt whereTimeTakenSeconds($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizAttempt whereTotalQuestions($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizAttempt whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizAttempt whereUserId($value)
 */
	class QuizAttempt extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $quiz_id
 * @property string $question
 * @property array<array-key, mixed> $options
 * @property string $correct_answer
 * @property string|null $explanation
 * @property int $points
 * @property int $order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Quiz $quiz
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizQuestion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizQuestion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizQuestion query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizQuestion whereCorrectAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizQuestion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizQuestion whereExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizQuestion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizQuestion whereOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizQuestion whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizQuestion wherePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizQuestion whereQuestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizQuestion whereQuizId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizQuestion whereUpdatedAt($value)
 */
	class QuizQuestion extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $savings_target_id
 * @property numeric $amount
 * @property \Illuminate\Support\Carbon $saved_date
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\SavingsTarget $savingsTarget
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavingsProgress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavingsProgress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavingsProgress query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavingsProgress whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavingsProgress whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavingsProgress whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavingsProgress whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavingsProgress whereSavedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavingsProgress whereSavingsTargetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavingsProgress whereUpdatedAt($value)
 */
	class SavingsProgress extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property numeric $target_amount
 * @property numeric $current_amount
 * @property string $frequency
 * @property numeric $frequency_amount
 * @property \Illuminate\Support\Carbon $target_date
 * @property \Illuminate\Support\Carbon $start_date
 * @property string $status
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $progress_percentage
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SavingsProgress> $progress
 * @property-read int|null $progress_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavingsTarget newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavingsTarget newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavingsTarget query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavingsTarget whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavingsTarget whereCurrentAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavingsTarget whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavingsTarget whereFrequency($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavingsTarget whereFrequencyAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavingsTarget whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavingsTarget whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavingsTarget whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavingsTarget whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavingsTarget whereTargetAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavingsTarget whereTargetDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavingsTarget whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SavingsTarget whereUserId($value)
 */
	class SavingsTarget extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Article> $articles
 * @property-read int|null $articles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ChatbotConversation> $chatbotConversations
 * @property-read int|null $chatbot_conversations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Consultation> $consultations
 * @property-read int|null $consultations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\FinancialRecord> $financialRecords
 * @property-read int|null $financial_records_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\QuizAttempt> $quizAttempts
 * @property-read int|null $quiz_attempts_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SavingsTarget> $savingsTargets
 * @property-read int|null $savings_targets_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

