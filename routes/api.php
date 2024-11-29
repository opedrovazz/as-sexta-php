<?php
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\ArtworkController;

Route::apiResource('artists', ArtistController::class);
Route::apiResource('artworks', ArtworkController::class);
