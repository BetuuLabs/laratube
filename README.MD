# LaraTube - YouTube Video Manage

**Please note, that this package will only work with a single YouTube account and does not support multiple accounts.**

## Installation

To install, use the following to pull the package in via Composer.

```
composer require betuulabs/laratube
```

Now register the Service provider in `config/app.php`

```php
'providers' => [
    ...
    Betuulabs\Laratube\LaratubeServiceProvider::class,
],
```

And also add the alias to the same file.

```php
'aliases' => [
    ...
    'Youtube' => Betuulabs\Laratube\Facades\Laratube::class,
],
```

## Configuration

Now publish the `laratube.php` config and migrations. 

```
php artisan vendor:publish --provider="Betuulabs\Laratube\LaratubeServiceProvider"
```

`php artisan migrate`


### Obtaining your Credentials

Create an application on [Google's Developer Console](https://console.developers.google.com/project). You then need to head into **Credentials** within the Console to create Server key.


Create the credentials and you will be provided with a **Client ID** and **Client Secret**. These now need to be added to your `.env` file.

```
GOOGLE_CLIENT_ID=YOUR_CLIENT_ID
GOOGLE_CLIENT_SECRET=YOUR_SECRET
```

# Code example


## Upload a Video

To upload a video, you simply need to pass the **full** path to your video you wish to upload and specify your video information.

Here's an example:

```php
$video = Laratube::upload($fullPathToVideo, [
    'title'       => 'My Awesome Video',
    'description' => 'You can also specify your video description here.',
    'tags'	      => ['foo', 'bar', 'baz'],
    'category_id' => 10
]);

return $video->getVideoId();
```

The above will return the ID of the uploaded video to YouTube. (*i.e dQw4w9WgXcQ*)

By default, video uploads are public. If you would like to change the privacy of the upload, you can do so by passing a third parameter to the upload method.

For example, the below will upload the video as `unlisted`.

```php
$video = Youtube::upload($fullPathToVideo, $params, 'unlisted');
```

### Custom Thumbnail

If you would like to set a custom thumbnail for for upload, you can use the `withThumbnail()` method via chaining.

```php
$fullpathToImage = storage_path('app/public/thumbnail.jpg');

$video = Youtube::upload($fullPathToVideo, $params)->withThumbnail($fullpathToImage);

return $youtube->getThumbnailUrl();
```

**Please note, the maxiumum filesize for the thumbnail is 2MB**. Setting a thumbnail will not work if you attempt to use a thumbnail that exceeds this size.

# Updating a Video

To update a video, you simply need to pass the **videoId** of the video you wish to update and specify your video information.

Here's an example:

```php
$video = Youtube::update($videoId, [
    'title'       => 'My Awesome Video',
    'description' => 'You can also specify your video description here.',
    'tags'	      => ['foo', 'bar', 'baz'],
    'category_id' => 10
], $privacy);

return $video->getVideoId();
```

Note: This request is explicit. Any params left out of the request will be removed.

# Deleting a Video

If you would like to delete a video, which of course is uploaded to your authorized channel, you will also have the ability to delete it:

```php
Youtube::delete($videoId);
```

When deleting a video, it will check if exists before attempting to delete.

# Questions

Should you have any questions, please feel free to submit an issue.
