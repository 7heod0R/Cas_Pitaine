<?php
$bateaux = $bateaux ?? [];
$pdfGenere = $pdfGenere ?? false;
$erreur = $erreur ?? null;
$photosParDefaut = [
    1 => 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=1000&q=85',
    2 => 'https://images.unsplash.com/photo-1500375592092-40eb2168fd21?auto=format&fit=crop&w=1000&q=85',
];
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cas Pitaine | Bateaux voyageurs</title>
    <style>
        :root { --ink: #17232b; --muted: #61717a; --blue: #0b6477; --pale: #e9f4f2; --line: #d7e3e1; --coral: #ee765d; }
        * { box-sizing: border-box; }
        body { margin: 0; background: #f4f7f5; color: var(--ink); font: 16px/1.5 Georgia, serif; }
        header { padding: 42px max(24px, calc((100% - 1100px) / 2)); background: linear-gradient(120deg, #17232b 0%, #0b6477 100%); color: white; }
        .header-inner, main, footer { max-width: 1100px; margin: auto; }
        .eyebrow { color: var(--coral); font: 700 11px/1 Arial, sans-serif; letter-spacing: 2px; }
        header p { margin: 6px 0 0; color: #b9d3d0; }
        main { padding: 34px 24px 50px; }
        .bar { display: flex; justify-content: space-between; align-items: end; gap: 20px; margin-bottom: 22px; }
        h1, h2 { margin: 0; font-weight: normal; } h1 { font-size: clamp(2rem, 5vw, 3.6rem); } h2 { font-size: 1.7rem; }
        .button { display: inline-block; padding: 14px 20px; border-radius: 4px; background: var(--coral); color: white; text-decoration: none; font: 15px Arial, sans-serif; transition: transform .2s, background .2s; }
        .button:hover { background: #d85d48; transform: translateY(-2px); }
        .button span { font-size: 18px; vertical-align: -1px; margin-right: 6px; }
        .notice, .error { padding: 15px 18px; border-left: 4px solid var(--blue); background: var(--pale); margin-bottom: 22px; }
        .notice a { color: var(--blue); font-weight: bold; }
        .error { border-color: #a62f2f; background: #fff0f0; color: #761e1e; }
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 18px; }
        article { overflow: hidden; background: white; border: 1px solid var(--line); box-shadow: 0 5px 18px rgba(23,35,43,.06); transition: transform .2s, box-shadow .2s; }
        article:hover { transform: translateY(-4px); box-shadow: 0 12px 26px rgba(23,35,43,.12); }
        .photo { height: 190px; position: relative; background: #b9d3d0; overflow: hidden; }
        .photo img { width: 100%; height: 100%; display: block; object-fit: cover; }
        .tag { position: absolute; top: 14px; left: 14px; padding: 6px 9px; color: white; background: var(--coral); font: 700 10px Arial, sans-serif; letter-spacing: 1px; }
        .card-content { padding: 22px; } article h3 { margin: 0 0 13px; font-size: 1.5rem; color: var(--blue); }
        dl { margin: 0 0 16px; display: grid; grid-template-columns: 1fr 1fr; gap: 8px; } dt { color: var(--muted); } dd { margin: 0; text-align: right; }
        .equipment { border-top: 1px solid var(--line); padding-top: 13px; color: var(--muted); }
        footer { padding: 0 24px 30px; color: var(--muted); font: 13px Arial, sans-serif; }
        @media (max-width: 600px) { .bar { align-items: flex-start; flex-direction: column; } }
    </style>
</head>
<body>
<header><div class="header-inner"><span class="eyebrow">FLOTTE VOYAGEURS</span><h1>Cas Pitaine</h1><p>Une flotte à découvrir, une brochure à générer.</p></div></header>
<main>
    <?php if ($erreur !== null): ?>
        <div class="error"><strong>Connexion impossible</strong><br><?= htmlspecialchars($erreur, ENT_QUOTES, 'UTF-8') ?><br><br>Importez <strong>database.sql</strong> dans phpMyAdmin, puis rechargez cette page.</div>
    <?php else: ?>
        <?php if ($pdfGenere): ?><div class="notice">Le PDF a été généré. <a href="output/BateauVoyageur.pdf" target="_blank">Ouvrir le PDF</a></div><?php endif; ?>
        <div class="bar"><div><span class="eyebrow">CATALOGUE</span><h2><?= count($bateaux) ?> bateau<?= count($bateaux) > 1 ? 'x' : '' ?> voyageur<?= count($bateaux) > 1 ? 's' : '' ?></h2></div><a class="button" href="?generer=1"><span>↓</span> Générer la brochure PDF</a></div>
        <section class="grid">
        <?php foreach ($bateaux as $bateau): ?>
            <?php $photoLocale = 'images/bateauvoyageur/bateau-' . (int) $bateau['id'] . '.jpg'; $photo = file_exists(__DIR__ . '/../' . $photoLocale) ? $photoLocale : (trim((string) $bateau['image']) ?: ($photosParDefaut[(int) $bateau['id']] ?? '')); ?>
            <article><div class="photo"><img src="<?= htmlspecialchars($photo, ENT_QUOTES, 'UTF-8') ?>" alt="Photo du bateau <?= htmlspecialchars($bateau['nom'], ENT_QUOTES, 'UTF-8') ?>" loading="lazy"><span class="tag">VOYAGEUR</span></div><div class="card-content"><h3><?= htmlspecialchars($bateau['nom'], ENT_QUOTES, 'UTF-8') ?></h3><dl><dt>Longueur</dt><dd><?= htmlspecialchars($bateau['longueur']) ?> m</dd><dt>Largeur</dt><dd><?= htmlspecialchars($bateau['largeur']) ?> m</dd><dt>Vitesse</dt><dd><?= htmlspecialchars($bateau['vitesse']) ?> noeuds</dd></dl><div class="equipment"><strong>Equipements :</strong><br><?= htmlspecialchars($bateau['equipements'] ?: 'Aucun') ?></div></div></article>
        <?php endforeach; ?>
        </section>
    <?php endif; ?>
</main>
<footer>Application PHP compatible XAMPP / Apache / MySQL</footer>
</body>
</html>
