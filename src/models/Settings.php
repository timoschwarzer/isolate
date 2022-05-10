<?php
/**
 * Isolate plugin for Craft CMS 3.x
 *
 * Force users to only access a subset of your entries
 *
 * @link      https://trendyminds.com
 * @copyright Copyright (c) 2019 TrendyMinds
 */

namespace trendyminds\isolate\models;

use trendyminds\isolate\Isolate;

use Craft;
use craft\base\Model;

/**
 * @author    TrendyMinds
 * @package   Isolate
 * @since     1.0.0
 */
class Settings extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $sidebarLabel = 'Entries';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            ['sidebarLabel', 'string'],
            ['sidebarLabel', 'default', 'value' => 'Entries'],
        ];
    }
}
