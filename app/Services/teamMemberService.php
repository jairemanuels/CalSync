<?php

namespace App\Services;

use App\Models\TeamMember;

class teamMemberService
{

    public function generateColor($teamId)
    {
        // pluck('color') pakt alleen de 'color' kolom
        // filter() verwijdert eventuele null of lege waarden
        $usedColors = TeamMember::where('team_id', $teamId)->pluck('color')->filter();

        $palette = [
            "#c4cea1","#d9e0a3","#fdf2b0","#f3d17c","#cf9963"
        ];

        $palette2 = [
            "#ffc8dd","#ffafcc","#bdb2ff","#bde0fe","#a2d2ff"
        ];

        // Vergelijk het originele palet met de gebruikte kleuren
        // diff() haalt alle kleuren eruit die al gebruikt zijn
        // Resultaat: alleen de kleuren die nog niet zijn gebruikt
        $availableColors = collect($palette)->diff($usedColors);

        // Als alle kleuren zijn gebruikt, reset dan het beschikbare palet
        // Dit zorgt ervoor dat we opnieuw kunnen beginnen met kleuren toewijzen
        if ($availableColors->isEmpty()) {
            $availableColors = collect($palette2);
        }

        // Selecteer willekeurig een kleur uit de beschikbare kleuren
        // random() kiest een willekeurige kleur uit de collectie
        return $availableColors->random();
    }
}
