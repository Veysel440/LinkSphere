<?php

namespace App\Services\Security;

class KeywordFilterService
{
    /**
     * Uygunsuz/banned kelimeler listesi
     * Buraya istediğin kadar kelime ekleyebilirsin.
     */
    protected array $bannedWords = [
        'küfür1',
        'küfür2',
        'badword',
        'hack',
        // ...
    ];

    /**
     * Yorum/metinde yasaklı kelime içeriyor mu?
     */
    public function containsBannedWords(string $text): bool
    {
        foreach ($this->bannedWords as $word) {
            if (stripos($text, $word) !== false) {
                return true;
            }
        }
        return false;
    }
}
