<?php
/**
 * Isolate plugin for Craft CMS 3.x
 *
 * Force users to only access a subset of your entries
 *
 * @link      https://trendyminds.com
 * @copyright Copyright (c) 2019 TrendyMinds
 */

namespace trendyminds\isolate\controllers;

use trendyminds\isolate\Isolate;

use Craft;
use craft\web\Controller;
use craft\elements\User;

/**
 * @author    TrendyMinds
 * @package   Isolate
 * @since     1.0.0
 */
class UsersController extends Controller
{

    // Protected Properties
    // =========================================================================

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     *         The actions must be in 'kebab-case'
     * @access protected
     */
    protected array|int|bool $allowAnonymous = [];

    // Public Methods
    // =========================================================================
    /**
     * @return mixed
     */
    public function actionSave()
    {
        $this->requirePostRequest();

        $userId = Craft::$app->getRequest()->getBodyParam("userId");
        $sectionId = Craft::$app->getRequest()->getBodyParam("sectionId");
        $entries = Craft::$app->getRequest()->getBodyParam("entries");

        if (!$entries) {
            $entries = [];
        }

        Isolate::$plugin->isolateService->modifyRecords(
            $userId,
            $sectionId,
            $entries
        );
    }

    /**
     * @return mixed
     */
    public function actionIndex(int $groupId = null)
    {
        $userGroup = null;
        $activeGroupId = null;

        if (isset($groupId)) {
            $userGroup = Craft::$app->userGroups->getGroupById($groupId);
            $activeGroupId = $userGroup->id;
        }

        return $this->renderTemplate('isolate/users', [
            "userGroup" => $userGroup,
            "activeGroupId" => $activeGroupId
        ]);
    }

    /**
     * @return mixed
     */
    public function actionUser(int $userId, string $sectionHandle = null)
    {
        $user = User::findOne([
            "id" => $userId
        ]);

        $section = null;

        if (isset($sectionHandle)) {
            $section = Craft::$app->sections->getSectionByHandle($sectionHandle);
        }

        return $this->renderTemplate('isolate/users/_user', [
            "user" => $user,
            "section" => $section
        ]);
    }
}
