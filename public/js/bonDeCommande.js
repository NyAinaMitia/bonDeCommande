        const tva = 20;

        // Fonction pour calculer le total HT
        function calculateTotalHT(quantite, prixUnitaire) {
            return quantite * prixUnitaire;
        }

        // Fonction pour calculer le total TTC en fonction de la TVA
        function calculateTotalTTC(totalHT, tva) {
            if (isNaN(totalHT) || isNaN(tva)) {
                return 0;
            }
            let montantTVA = totalHT * (tva / 100);
            let totalTTC = totalHT + montantTVA;
            return totalTTC.toFixed(2);
        }

        function calculateRemise(totalTTC, pourcentageRemise) {
            if (isNaN(totalTTC) || isNaN(pourcentageRemise)) {
                return 0;
            }
            let montantRemise = totalTTC * (pourcentageRemise / 100);
            let totalRemise = totalTTC - montantRemise;
            return totalRemise.toFixed(2);
        }

        // Mettre à jour les champs en fonction des changements
        function updateFields(champ) {
            const row = champ.closest('.table-row');
            const quantite = parseFloat(row.querySelector('.quantite').value) || 0;
            const prixUnitaire = parseFloat(row.querySelector('.prix-unitaire').value) || 0;
            const totalHT = calculateTotalHT(quantite, prixUnitaire);
            row.querySelector('.total-ht').value = totalHT.toFixed(2);
            const pourcentageRemise = parseFloat(row.querySelector('.pourcentageRemise').value) || 0;
            console.log(pourcentageRemise);
        
            const tva = row.querySelector('.tva').checked;
            const montant_tva = row.querySelector('.montant_tva');
            if (tva) {
                montant_tva.value = 20;
                const totalTTC = calculateTotalTTC(totalHT, montant_tva.value);
                const totalRemise = calculateRemise(totalTTC, pourcentageRemise);
                row.querySelector('.total-ttc').value = totalTTC;
                row.querySelector('.total-remise').value = totalRemise;
            } else {
                montant_tva.value = 0;
                const totalRemise = calculateRemise(totalHT, pourcentageRemise);
                row.querySelector('.total-ttc').value = totalHT.toFixed(2);
                row.querySelector('.total-remise').value = totalRemise;
            }

            updateGrandTotals();

        }

        function addRow() {
            // Sélectionnez la première ligne du tableau (l'en-tête)
            const headerRow = document.querySelector('table tbody tr');
        
            if(headerRow)
            {
                // Clonez la première ligne
                const newRow = headerRow.cloneNode(true);
                newRow.classList.add('added-row');

                newRow.querySelectorAll('input').forEach(input => {
                    if (input.type === 'checkbox') {
                        input.checked = false; // Réinitialisez la case à cocher
                    } else {
                        input.value = ''; // Réinitialisez les autres champs
                    }
                });

                    // Ajoutez le bouton "Annuler"
                const cancelBtn = document.createElement('button');
                cancelBtn.textContent = 'Annuler';
                cancelBtn.className = 'btn btn-danger';
                cancelBtn.addEventListener('click', () => {
                    newRow.remove();
                    updateGrandTotals();
                });

                const actionsCell = newRow.querySelector('.cancel-cell');
                actionsCell.innerHTML = '';
                actionsCell.appendChild(cancelBtn);
            
                // Trouvez la dernière ligne avant les deux dernières lignes
                const lastRows = document.querySelectorAll('table tbody tr:nth-last-child(-n+3)');
                const lastRowBeforeFooter = lastRows[0];
                // Ajoutez la nouvelle ligne avant la dernière ligne avant le footer
                lastRowBeforeFooter.parentNode.insertBefore(newRow, lastRowBeforeFooter);
                updateGrandTotals()
            }

        }
        updateGrandTotals();
        // Fonction pour mettre à jour les totaux globaux
        function updateGrandTotals() {
            const grandTotalHTInput = document.getElementById('grand-total-ht');
            const totalTVAInput = document.getElementById('total-tva');
            const grandTotalTTCInput = document.getElementById('grand-total-ttc');
            const totalRemiseInput = document.getElementById('total-remise');
            const grandTotalRemiseInput = document.getElementById('grand-total-remise');

            let totalHT = 0;
            let totalTTC = 0;
            let grandTotalRemise = 0;

            // Parcourir toutes les lignes du tableau sauf les deux dernières
            document.querySelectorAll('.table-row:not(.grand-total-row)').forEach(row => {

                const totalHTInput = row.querySelector('.total-ht');
                const totalTTCInput = row.querySelector('.total-ttc');
                const totalRemiseInput = row.querySelector('.total-remise');

                const currentTotalHT = parseFloat(totalHTInput.value) || 0;
                const currentTotalTTC = parseFloat(totalTTCInput.value) || 0;
                const currentTotalRemise = parseFloat(totalRemiseInput.value) || 0;


                totalHT += currentTotalHT;
                totalTTC += currentTotalTTC;
                grandTotalRemise += currentTotalRemise;
            });

            const totalTVA = totalTTC - totalHT;
            const totalRemise = totalTTC - grandTotalRemise;

            grandTotalHTInput.value = totalHT.toFixed(2);
            totalTVAInput.value = totalTVA.toFixed(2);
            if (totalTVA >= 0) {
               
            } else {
                totalTVAInput.value = 'valeur négatif'; // Ne pas afficher si négatif
            }
            grandTotalTTCInput.value = totalTTC.toFixed(2);
            totalRemiseInput.value = totalRemise.toFixed(2);
            grandTotalRemiseInput.value = grandTotalRemise.toFixed(2);
        }
        // Sélectionnez l'élément input date
        const dacInput = document.getElementById('dac');
        const currentYear = new Date().getFullYear();
        const currentDate = `${currentYear}`;
        dacInput.value = currentDate;

        function activateRemise() {
            const remiseCheckbox = document.getElementById('remiseCheckbox');
            const pourcentageRemiseInput = document.getElementById('pourcentageRemiseGlobale');
            const remiseInputs = document.querySelectorAll('#pourcentageRemise');

            pourcentageRemiseInput.disabled = !remiseCheckbox.checked;
            remiseInputs.forEach(input => {
                input.disabled = !remiseCheckbox.checked;
                if (remiseCheckbox.checked) {
                    input.value = pourcentageRemiseInput.value;
                } else {
                    input.value = '';
                }
                updateFields(input);
            });
            if (!remiseCheckbox.checked && pourcentageRemiseInput.disabled) {
                pourcentageRemiseInput.value = '';
                remiseInputs.forEach(input => {
                    input.disabled = false;
                    input.value = '';
                    updateFields(input);
                });
            }
        }

