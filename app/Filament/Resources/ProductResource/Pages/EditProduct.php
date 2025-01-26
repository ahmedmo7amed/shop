<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function afterSave(): void
    {
        // الحصول على الصور المرفوعة من النموذج
        $uploadedImages = $this->data['images'] ?? [];

        // التحقق من وجود صور مرفوعة
        if (!empty($uploadedImages)) {
            // استدعاء الدالة لتحديث الصور
            ProductResource::storeImages($this->record, $uploadedImages);
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
