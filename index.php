<?php

$success = "";
$error = "";

if(isset($_POST['envoyer'])){

    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // EMAIL DE LA BOUTIQUE
    $to = "pressingantimele@gmail.com";

    // SUJET DU MAIL
    $subject = "Nouveau message depuis le site ANTIMELE";

    // CONTENU DU MESSAGE
    $body = "
    Nouveau message reçu depuis le site ANTIMELE :

    Nom : $nom

    Email : $email

    Message :
    $message
    ";

    // HEADERS
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // ENVOI
    if(mail($to, $subject, $body, $headers)){
        $success = "Votre message a été envoyé avec succès !";
    } else {
        $error = "Erreur lors de l'envoi du message.";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ANTIMELE - Pressing & Prêt-à-Porter</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="images/logo-antimele.png" type="jpg">

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            scroll-behavior:smooth;
        }

        body{
            font-family:'Poppins', sans-serif;
            background:#f5f7fa;
            color:#222;
            overflow-x:hidden;
        }

        header{
            position:fixed;
            width:100%;
            top:0;
            left:0;
            background:rgba(0,0,0,0.85);
            backdrop-filter:blur(10px);
            z-index:1000;
            padding:15px 8%;
            display:flex;
            justify-content:space-between;
            align-items:center;
            transition:0.4s;
        }
/* LOGO */

        .logo-container{
            display:flex;
            align-items:center;
            gap:12px;
        }

        .site-logo{
            width:60px;
            height:60px;
            border-radius:50%;
            object-fit:cover;
            border:3px solid #00c2ff;
            box-shadow:0 5px 15px rgba(0,194,255,0.4);
        }

        .logo{
            color:#fff;
            font-size:32px;
            font-weight:700;
            letter-spacing:2px;
        }

        .logo span{
            color:#00c2ff;
        }

        nav ul{
            display:flex;
            list-style:none;
            gap:25px;
        }

        nav ul li a{
            text-decoration:none;
            color:white;
            font-weight:500;
            transition:0.3s;
        }

        nav ul li a:hover{
            color:#00c2ff;
        }

        .hero{
            height:100vh;
            background:linear-gradient(rgba(0,0,0,0.6),rgba(0,0,0,0.7)),url('images/antimele.jpg');
            background-size:cover;
            background-position:center;
            display:flex;
            align-items:center;
            justify-content:center;
            text-align:center;
            color:white;
            padding:20px;
        }

        .hero-content{
            animation:fadeUp 1.5s ease;
        }

        .hero h1{
            font-size:70px;
            margin-bottom:20px;
        }

        .hero h1 span{
            color:#00c2ff;
        }

        .hero p{
            font-size:22px;
            margin-bottom:35px;
        }

        .btn{
            display:inline-block;
            padding:15px 35px;
            background:#00c2ff;
            color:white;
            text-decoration:none;
            border-radius:50px;
            font-weight:600;
            transition:0.4s;
            box-shadow:0 10px 25px rgba(0,194,255,0.4);
        }

        .btn:hover{
            transform:translateY(-5px) scale(1.05);
            background:#0098c7;
        }

        section{
            padding:100px 8%;
        }

        .title{
            text-align:center;
            margin-bottom:60px;
        }

        .title h2{
            font-size:42px;
            color:#111;
            margin-bottom:10px;
        }

        .title p{
            color:#666;
        }

        .services{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
            gap:30px;
        }

        .card{
            background:white;
            border-radius:20px;
            padding:35px;
            text-align:center;
            transition:0.5s;
            box-shadow:0 10px 30px rgba(0,0,0,0.08);
            position:relative;
            overflow:hidden;
        }

        .card::before{
            content:'';
            position:absolute;
            width:100%;
            height:5px;
            background:#00c2ff;
            top:0;
            left:0;
        }

        .card:hover{
            transform:translateY(-15px);
            box-shadow:0 20px 40px rgba(0,0,0,0.15);
        }

        .card h3{
            margin:20px 0;
            font-size:25px;
        }

        .card p{
            color:#666;
            line-height:1.7;
        }

        .products{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
            gap:30px;
        }

        .product{
            background:white;
            border-radius:20px;
            overflow:hidden;
            transition:0.5s;
            box-shadow:0 10px 30px rgba(0,0,0,0.08);
        }

        .product:hover{
            transform:scale(1.04);
        }

        .product img{
            width:100%;
            height:280px;
            object-fit:cover;
        }

        .product-content{
            padding:25px;
            text-align:center;
        }

        .product-content h3{
            margin-bottom:10px;
        }

        .about{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(300px,1fr));
            gap:50px;
            align-items:center;
        }

        .about img{
            width:100%;
            border-radius:20px;
            box-shadow:0 10px 30px rgba(0,0,0,0.2);
        }

        .about-text h3{
            font-size:40px;
            margin-bottom:20px;
        }

        .about-text p{
            line-height:1.9;
            color:#555;
            margin-bottom:20px;
        }

        .stats{
            background:#111;
            color:white;
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
            gap:30px;
            text-align:center;
        }

        .stat-box h2{
            font-size:55px;
            color:#00c2ff;
        }

        .contact-container{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(320px,1fr));
            gap:40px;
        }

        .contact-info{
            background:white;
            padding:40px;
            border-radius:20px;
            box-shadow:0 10px 30px rgba(0,0,0,0.08);
        }

        .contact-info h3{
            margin-bottom:25px;
            font-size:30px;
        }

        .contact-info p{
            margin-bottom:18px;
            color:#555;
        }

        form{
            background:white;
            padding:40px;
            border-radius:20px;
            box-shadow:0 10px 30px rgba(0,0,0,0.08);
        }

        form input,
        form textarea{
            width:100%;
            padding:15px;
            margin-bottom:20px;
            border:none;
            border-radius:10px;
            background:#f0f4f8;
            font-size:16px;
        }

        form textarea{
            resize:none;
            height:160px;
        }

        form button{
            border:none;
            cursor:pointer;
        }

        footer{
            background:#000;
            color:white;
            text-align:center;
            padding:30px;
        }

        .success{
            background:#d4edda;
            color:#155724;
            padding:15px;
            margin-bottom:20px;
            border-radius:10px;
        }

        .floating{
            animation:floating 3s ease-in-out infinite;
        }

        @keyframes fadeUp{
            from{
                opacity:0;
                transform:translateY(50px);
            }
            to{
                opacity:1;
                transform:translateY(0);
            }
        }

        @keyframes floating{
            0%{
                transform:translateY(0px);
            }
            50%{
                transform:translateY(-15px);
            }
            100%{
                transform:translateY(0px);
            }
        }

        .reveal{
            opacity:0;
            transform:translateY(60px);
            transition:all 1s ease;
        }

        .reveal.active{
            opacity:1;
            transform:translateY(0);
        }

        @media(max-width:900px){
            .hero h1{
                font-size:45px;
            }

            nav ul{
                gap:15px;
            }
        }

        @media(max-width:700px){
            header{
                flex-direction:column;
                gap:15px;
            }

            nav ul{
                flex-wrap:wrap;
                justify-content:center;
            }

            .hero h1{
                font-size:35px;
            }

            .hero p{
                font-size:18px;
            }
        }
    </style>
</head>
<body>

<header>

<div class="logo-container">

    <img src="images/logo-antimele.png"
    alt="Logo ANTIMELE"
    class="site-logo">

    <div class="logo">
        ANTI<span>MELE</span>
    </div>

</div>


    <nav>
        <ul>
            <li><a href="#home">Accueil</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#boutique">Boutique</a></li>
            <li><a href="#about">À propos</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
    </nav>
</header>

<section class="hero" id="home">
    <div class="hero-content">
        <h1 class="floating">BIENVENUE CHEZ <span>ANTIMELE</span></h1><br>
        <p>Votre pressing moderne et boutique prêt-à-porter élégante.</p>
        <a href="#services" class="btn">Découvrir nos services</a>
    </div>
</section>

<section id="services">
    <div class="title reveal">
        <h2>NOS SERVICES</h2>
        <p>Des prestations rapides, propres et professionnelles.</p>
    </div>

    <div class="services">
        <div class="card reveal">
            <h3>Lavage à Sec</h3>
            <p>Nettoyage professionnel de vos vêtements délicats avec des produits de haute qualité.</p>
        </div>

        <div class="card reveal">
            <h3>Repassage</h3>
            <p>Repassage impeccable pour chemises, pantalons, costumes et autres vêtements.</p>
        </div>

        <div class="card reveal">
            <h3>Entretien Premium</h3>
            <p>Protection et entretien avancé pour conserver l’élégance de vos habits.</p>
        </div>
    </div>
</section><hr style="height: 7px; background-color: #00c2ff;">

<section id="boutique">
    <div class="title reveal">
        <h2>NOTRE BOUTIQUE</h2>
        <p>Découvrez nos articles tendance et élégants.</p>
    </div>

    <div class="products">
        <div class="product reveal">
            <img src="https://images.unsplash.com/photo-1602810318383-e386cc2a3ccf?q=80&w=1200&auto=format&fit=crop">
            <div class="product-content">
                <h3>Chemises</h3>
                <p>Des chemises modernes pour hommes et femmes.</p>
            </div>
        </div>

        <div class="product reveal">
            <img src="https://images.unsplash.com/photo-1542272604-787c3835535d?q=80&w=1200&auto=format&fit=crop">
            <div class="product-content">
                <h3>Pantalons</h3>
                <p>Pantalons élégants et confortables pour toutes occasions.</p>
            </div>
        </div>

        <div class="product reveal">
            <img src="https://images.unsplash.com/photo-1617038220319-276d3cfab638?q=80&w=1200&auto=format&fit=crop">
            <div class="product-content">
                <h3>Chaînes & Accessoires</h3>
                <p>Des accessoires raffinés pour compléter votre style.</p>
            </div>
        </div>

        <div class="product reveal">
            <img src="https://images.unsplash.com/photo-1594035910387-fea47794261f?q=80&w=1200&auto=format&fit=crop">
            <div class="product-content">
                <h3>Parfums</h3>
                <p>Des parfums de qualité pour une touche de fraîcheur et de luxe.</p>
            </div>
        </div>
    </div>
</section><hr style="height: 7px; background-color: #00c2ff;">

<section id="about">
    <div class="about">
        <img class="reveal" src="https://images.unsplash.com/photo-1512436991641-6745cdb1723f?q=80&w=1200&auto=format&fit=crop">

        <div class="about-text reveal">
            <h3>À PROPOS DE ANTIMELE</h3>
            <p>
                ANTIMELE est un pressing et une boutique prêt-à-porter moderne proposant des services de lavage à sec, repassage et entretien de vêtements en 24H.
            </p>

            <p>
                Nous proposons également des chemises, pantalons, chaînes, parfums et plusieurs accessoires de mode avec une qualité exceptionnelle.
            </p>

            <a href="#contact" class="btn">Nous contacter</a>
        </div>
    </div>
</section>

<section class="stats">
    <div class="stat-box reveal">
        <h2 class="counter" data-target="+1574">0</h2>
        <p>Clients satisfaits</p>
    </div>

    <div class="stat-box reveal">
        <h2 class="counter" data-target="11">0</h2>
        <p>Années d'expérience</p>
    </div>

    <div class="stat-box reveal">
        <h2 class="counter" data-target="+27326">0</h2>
        <p>Vêtements nettoyés</p>
    </div>
</section>

<section id="contact">
    <div class="title reveal">
        <h2>CONTACTEZ-NOUS</h2>
        <p>Nous sommes disponibles pour vos commandes et informations.</p>
    </div>

    <div class="contact-container">
        <div class="contact-info reveal">
            <h3>INFORMATIONS</h3>

            <p><strong>Nom :</strong> ANTIMELE</p>
            <p><strong>Services :</strong> Pressing & Prêt-à-Porter</p>
            <p><strong>Téléphone :</strong> +228 98 16 26 26</p>
            <p><strong>Email :</strong> pressingantimele@gmail.com</p>
            <p><strong>Adresse :</strong> Lomé,Avedji coller à la microfinance Coecept</p>
            <p><strong>Horaires :</strong></p>
            <p>Lundi - Jeudi : 7h00 à 20h00</p>
            <p>Vendredi - Samedi : 7H00 à 21H00</p>
        </div>

        <form method="POST" class="reveal">
            <?php if(isset($success)){ ?>
                <div class="success"><?php echo $success; ?></div>
            <?php } ?>

            <input type="text" name="nom" placeholder="Votre nom" required>
            <input type="email" name="email" placeholder="Numero" required>
            <textarea name="message" placeholder="Votre message" required></textarea>

            <button type="submit" name="envoyer" class="btn">Envoyer</button>
        </form>
    </div>
</section>

<footer>
    <p>© 2026 ANTIMELE - Pressing & Prêt-à-Porter</p>
</footer>

<script>

window.addEventListener('scroll', reveal);

function reveal(){
    let reveals = document.querySelectorAll('.reveal');

    for(let i = 0; i < reveals.length; i++){
        let windowHeight = window.innerHeight;
        let elementTop = reveals[i].getBoundingClientRect().top;
        let elementVisible = 100;

        if(elementTop < windowHeight - elementVisible){
            reveals[i].classList.add('active');
        }
    }
}

const counters = document.querySelectorAll('.counter');

counters.forEach(counter => {
    counter.innerText = '0';

    const updateCounter = () => {
        const target = +counter.getAttribute('data-target');
        const c = +counter.innerText;

        const increment = target / 200;

        if(c < target){
            counter.innerText = `${Math.ceil(c + increment)}`;
            setTimeout(updateCounter, 10);
        } else {
            counter.innerText = target;
        }
    };

    updateCounter();
});

window.addEventListener('scroll', function(){
    const header = document.querySelector('header');

    header.classList.toggle('sticky', window.scrollY > 50);
});

</script>

</body>
</html>