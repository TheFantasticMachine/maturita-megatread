<?php ?>
<!DOCTYPE html>
<html>
<head>
    <style></style>
</head>
<body>


<script>
    // ============================================================
    //  PROCES: Registrace uživatele
    //  Flowchart bloky (CZ → použití v kódu):
    //
    //  [START/END]    → začátek a konec funkce
    //  [PŘÍKAZ]       → běžné přiřazení / operace
    //  [PODMÍNKA]     → if / else větev
    //  [FOR]          → cyklus s určeným počtem opakování
    //  [WHILE]        → cyklus s podmínkou na začátku
    //  [DO-WHILE]     → cyklus s podmínkou na konci
    //  [VSTUP]        → ruční vstup (prompt / readline)
    //  [VÝSTUP]       → zobrazení výstupu (console.log / alert)
    //  [PODPROGRAM]   → volání samostatné funkce
    //  [SPOJKA]       → spojovací značka (místo, kde se větve slučují)
    // ============================================================


    // ── PODPROGRAM ──────────────────────────────────────────────
    // Samostatná funkce (podprogram) pro ověření síly hesla.
    // Vrací true pokud heslo splňuje požadavky.
    function overHeslo(heslo) {                              // [START/END podprogramu]
        const maDelku    = heslo.length >= 8;                 // [PŘÍKAZ]
        const maCislo    = /\d/.test(heslo);                  // [PŘÍKAZ]
        const maVelke    = /[A-Z]/.test(heslo);               // [PŘÍKAZ]
        return maDelku && maCislo && maVelke;                 // [PŘÍKAZ]
    }                                                        // [END podprogramu]


    // ── PODPROGRAM ──────────────────────────────────────────────
    // Simulace uložení do databáze (podprogram).
    // Vrací true při úspěchu (80% šance).
    function ulozUzivatele(jmeno, heslo) {                   // [START/END podprogramu]
        console.log(`[VÝSTUP] Ukládám uživatele "${jmeno}"…`); // [VÝSTUP]
        return Math.random() < 0.8; // simulace úspěchu/neúspěchu // [PŘÍKAZ]
    }                                                         // [END podprogramu]


    // ── HLAVNÍ ALGORITMUS ────────────────────────────────────────
    function registrace() {                                  // [START]

        // ── VSTUP: uživatelské jméno ──────────────────────────────
        let jmeno = prompt("Zadej uživatelské jméno:");        // [VSTUP]

        // ── WHILE: opakuj dokud je jméno prázdné ─────────────────
        while (!jmeno || jmeno.trim() === "") {                // [WHILE - podmínka na začátku]
            console.log("[VÝSTUP] Jméno nesmí být prázdné.");    // [VÝSTUP]
            jmeno = prompt("Zadej uživatelské jméno znovu:");    // [VSTUP]
        }                                                      // konec WHILE

        jmeno = jmeno.trim();                                  // [PŘÍKAZ]

        // ── DO-WHILE: opakuj dokud heslo nesplňuje požadavky ─────
        let heslo;
        do {                                                   // [DO-WHILE - podmínka na konci]
            heslo = prompt(                                      // [VSTUP]
                "Zadej heslo (min. 8 znaků, 1 velké písmeno, 1 číslo):"
            );

            // ── PODMÍNKA: je heslo platné? ────────────────────────
            if (overHeslo(heslo)) {                              // [PODMÍNKA] + [PODPROGRAM]
                console.log("[VÝSTUP] Heslo je v pořádku.");       // [VÝSTUP]
            } else {
                console.log("[VÝSTUP] Heslo nesplňuje požadavky."); // [VÝSTUP]
            }
        } while (!overHeslo(heslo));                           // konec DO-WHILE

        // ── FOR: pokus o uložení, max. 3 pokusy ──────────────────
        let ulozeno = false;                                   // [PŘÍKAZ]

        for (let pokus = 1; pokus <= 3; pokus++) {             // [FOR - určený počet opakování]
            console.log(`[VÝSTUP] Pokus č. ${pokus}…`);         // [VÝSTUP]

            ulozeno = ulozUzivatele(jmeno, heslo);               // [PŘÍKAZ] + [PODPROGRAM]

            // ── PODMÍNKA: uložení proběhlo? ──────────────────────
            if (ulozeno) {                                       // [PODMÍNKA]
                break; // úspěch → přeruš smyčku
            }
        }                                                      // konec FOR

        // ── SPOJOVACÍ ZNAČKA ──────────────────────────────────────
        // Obě větve (úspěch / neúspěch) se zde slučují zpět do
        // jednoho toku. Ve vývojovém diagramu by tu byl kroužek (○).
        // ── SPOJKA ───────────────────────────────────────────────

        // ── PODMÍNKA: výsledek registrace ────────────────────────
        if (ulozeno) {                                         // [PODMÍNKA]
            console.log(                                         // [VÝSTUP]
                `[VÝSTUP] ✓ Uživatel "${jmeno}" byl úspěšně zaregistrován!`
            );
        } else {
            console.log(                                         // [VÝSTUP]
                "[VÝSTUP] ✗ Registrace selhala po 3 pokusech. Zkuste to znovu."
            );
        }

    }                                                        // [END]


    // Spuštění hlavního algoritmu
    registrace();
</script>
</body>
</html>
