<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected function afterSave(): void
    {
        // الحصول على الصور المرفوعة من النموذج
        $uploadedImages = $this->data['images'] ?? [];
       $f= $this->data['product-images'] ?? [];
        // التحقق من وجود صور مرفوعة
        if (!empty($uploadedImages)) {
            // استدعاء الدالة لتخزين الصور
            ProductResource::storeImages($this->record, $uploadedImages);
        }
    }
}
