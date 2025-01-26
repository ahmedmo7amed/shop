<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\Pages\CreateProduct;
use App\Models\Product;
use App\Models\ProductImage;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static ?string $navigationGroup = 'Shop Management';

    private const IMAGE_DIRECTORY = 'product-images'; // Directory for storing images


    public static function storeImages(Product $product, array $images): void
    {
        foreach ($images as $imagePath) {
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $imagePath,
            ]);
        }
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('sku')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('barcode')
                    ->maxLength(255),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                Forms\Components\TextInput::make('cost')
                    ->numeric()
                    ->prefix('$'),
                Forms\Components\TextInput::make('quantity')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->minValue(0),
                Forms\Components\FileUpload::make('images')
                    ->label('Product Images')
                    ->multiple()
                    ->required()
                    ->disk('public')
                    ->directory(self::IMAGE_DIRECTORY)
                    ->image()
                    ->rules(['image', 'mimes:jpg,jpeg,png', 'max:2048']) // 2MB max size
                    ->imagePreviewHeight('100'),

                Repeater::make('options')
                    ->relationship('options')
                    ->schema([
                        Forms\Components\TextInput::make('name')->required(), // اسم الخيار (مثل: سعة)
                        Repeater::make('values')
                            ->relationship('values')
                            ->schema([
                                Forms\Components\TextInput::make('value')
                                    ->required()
                                    ->numeric(), // القيمة (مثل: سعة 5 لتر)
                                Forms\Components\TextInput::make('price')
                                    ->required()
                                    ->numeric(), // السعر الخاص بهذه السعة
                                Forms\Components\TextInput::make('length')->label('الطول')
                                    ->required()
                                    ->numeric(), // الطول
                                Forms\Components\TextInput::make('diameter')->label('القطر')
                                    ->required()
                                    ->numeric(), // القطر
                                Forms\Components\TextInput::make('height')->label('الارتفاع')
                                    ->required()
                                    ->numeric(), // الارتفاع
                            ])
                    ]),

                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->maxLength(65535),
                    ]),
                Forms\Components\Toggle::make('status')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sku')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean(),
                Tables\Columns\TextColumn::make('images_count')
                    ->label('Images')
                    ->getStateUsing(fn ($record) => $record->images()->count()),
                Tables\Columns\ImageColumn::make('product_images')
                    ->label('First Image')
                    ->getStateUsing(fn ($record) => $record->images()->first()?->image_path),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
