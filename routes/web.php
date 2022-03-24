<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CopyEntriesController;
use App\Http\Controllers\DriveEntriesController;
use App\Http\Controllers\EntryPathController;
use App\Http\Controllers\FoldersController;
use App\Http\Controllers\MoveFileEntriesController;
use App\Http\Controllers\ShareableLinkPasswordController;
use App\Http\Controllers\ShareableLinkPreviewController;
use App\Http\Controllers\ShareableLinksController;
use App\Http\Controllers\StarredEntriesController;
use App\Http\Controllers\UserFoldersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SharesController;
use App\Http\Controllers\SpaceUsageController;

Route::prefix('secure/drive')->middleware('web')->group(function () {
    Route::middleware('auth')->group(function () {
        //FOLDERS
        Route::get('folders/find', [FoldersController::class, 'show']);
        Route::get('folders', [FoldersController::class, 'index']);
        Route::post('folders', [FoldersController::class, 'store']);
        Route::get('users/{userId}/folders', [UserFoldersController::class, 'index']);

        //ENTRIES (COMMON FOR FILES/FOLDERS)
        Route::get('entries', [DriveEntriesController::class, 'index']);
        Route::post('entries', [DriveEntriesController::class, 'store']);
        Route::post('entries/move', [MoveFileEntriesController::class, 'move']);
        Route::delete('entries', [DriveEntriesController::class, 'destroy']);
        Route::post('entries/restore', [\Common\Files\Controllers\RestoreDeletedEntriesController::class, 'restore']);
        Route::get('entries/{id}/activity', [ActivityController::class, 'index']);
        Route::post('entries/copy', [CopyEntriesController::class, 'copy']);

        //STARS
        Route::post('entries/star', [StarredEntriesController::class, 'add']);
        Route::post('entries/unstar', [StarredEntriesController::class, 'remove']);

        //ENTRY PATHS
        Route::get('entries/{entryId}/path', [EntryPathController::class, 'getPath']);

        //SHARING
        Route::post('shareable-links/{linkId}/import', [SharesController::class, 'addCurrentUser']);
        Route::post('shares/add-users', [SharesController::class, 'addUsers']);
        Route::put('shares/change-permissions/{userId}', [SharesController::class, 'changePermissions']);
        Route::post('shares/remove-user/{userId}', [SharesController::class, 'removeUser']);

        //SHAREABLE LINKS
        Route::get('entries/{id}/shareable-link', [ShareableLinksController::class, 'show']);
        Route::post('entries/{id}/shareable-link', [ShareableLinksController::class, 'store']);
        Route::put('shareable-links/{id}', [ShareableLinksController::class, 'update']);
        Route::delete('shareable-links/{id}', [ShareableLinksController::class, 'destroy']);

        //SPACE USAGE
        Route::get('user/space-usage', [SpaceUsageController::class, 'index']);
    });

    //SHAREABLE LINKS PREVIEW (NO AUTH NEEDED)
    Route::get('shareable-links/{hash}', [ShareableLinksController::class, 'show']);
    Route::get('shareable-links/{linkId}/preview/{entryId}', [ShareableLinkPreviewController::class, 'show']);
    Route::post('shareable-links/{linkId}/check-password', [ShareableLinkPasswordController::class, 'check']);
});

//FRONT-END ROUTES THAT NEED TO BE PRE-RENDERED
Route::get('/', [\Common\Core\Controllers\HomeController::class, 'show'])->middleware('prerenderIfCrawler:homepage');

//CATCH ALL ROUTES AND REDIRECT TO HOME
Route::get('{all}', [\Common\Core\Controllers\HomeController::class, 'show'])->where('all', '.*');
