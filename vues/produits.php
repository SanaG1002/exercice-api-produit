<h2>Tableau produits</h2>
<table>

    <?php
        foreach ($produits as $produit) {
    ?>
        <tr>
            <td><?= $produit->id ?></td>
            <td><?= $produit->nom?></td>
            <td><?= $produit->description ?></td>
            <td><?= $produit->prix ?></td>
            <td><?= $produit->qteStock?></td>
            <td><?= $produit->description ?></td>
            <td><?= $produit->prix ?></td>
        </tr>
    <?php
        }
    ?>
</table>