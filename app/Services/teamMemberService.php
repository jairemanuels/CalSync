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
            '#1B1B2F', '#2F3E46', '#4D4D4D', '#8A8A8A', '#ABB2B9', '#77665E', '#ADA9A3', '#2C3E50', '#85929E'
        ];

        $palette2 = [
            "#582f0e","#7f4f24","#936639","#a68a64","#b6ad90","#c2c5aa","#a4ac86","#656d4a","#414833","#333d29"
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
