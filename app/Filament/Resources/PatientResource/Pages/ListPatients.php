<?php

namespace App\Filament\Resources\PatientResource\Pages;

use App\Filament\Resources\PatientResource;
use App\Models\Card;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPatients extends ListRecords
{
    protected static string $resource = PatientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Add New')
                ->icon('heroicon-o-plus-circle')
                ->mutateFormDataUsing(function (array $data): array {
                    // $card_id = Card::create([
                    //     'number' => $data['card_id'],
                    // ]);

                    // หาเลข card_id ล่าสุด
                    // $lastCard = Card::latest('id')->first();
                    // $newNumber = $lastCard ? str_pad($lastCard->id + 1, 6, '0', STR_PAD_LEFT) : '000001';

                    // สร้าง Card ใหม่พร้อมหมายเลขที่สร้างขึ้น
                    $card = Card::updateOrcreate(['number' => $data['card_id']]);
                    // ผูก card_id กับ Patient
                    $data['card_id'] = $card->id;
                    return $data;
                }),
        ];
    }
}
