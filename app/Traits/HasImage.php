<?php
namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasImage
{
    /**
     * حفظ الصورة في المسار المحدد
     *
     * @param UploadedFile $image
     * @param string $folder
     * @return string
     */
    public function saveImage(UploadedFile $image, $folder)
    {
       
        return $image->store($folder, 'public');
    }

    /**
     * تحديث الصورة: حذف القديمة وحفظ الجديدة
     *
     * @param UploadedFile $newImage
     * @param string $folder
     * @param string|null $oldImageUrl
     * @return string
     */
    public function updateImage(UploadedFile $newImage, $folder, $oldImageUrl = null)
    {
        if ($oldImageUrl) {
            $this->deleteImage($oldImageUrl);
        }

        return $this->saveImage($newImage, $folder);
    }

    /**
     * حذف الصورة
     *
     * @param string|null $imageUrl
     * @return void
     */
    public function deleteImage($imageUrl)
    {
        if (! $imageUrl) {
            return;
        }

        // استخراج المسار النسبي من الرابط الكامل إذا كان رابطاً
        $path = parse_url($imageUrl, PHP_URL_PATH);

        // إزالة '/storage/' للحصول على المسار داخل الديسك (public)
        // مثال: /storage/folder/image.jpg -> folder/image.jpg
        $path = str_replace('/storage/', '', $path);
        
        // التعامل مع بداية المسار
        $path = ltrim($path, '/');

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
