<?php
    $sql = "SELECT v.idUtilisateur, t.codeMode, SUM(t.montant) AS total_encaisse FROM vente v JOIN transactionvente t ON v.idVente = t.idVente WHERE v.dateVente BETWEEN '2025-02-17' AND '2025-02-17' GROUP BY v.idUtilisateur, t.codeMode ORDER BY v.idUtilisateur, t.codeMode";
?>