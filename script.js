// ============================================
// 1. STOCK DE PRODUITS
// ============================================
const stock = {
    chemises: [
        { nom: "Chemise Premium", prix: "12.000 FCFA", img: "images/chemise-premium.jpg" },
        { nom: "Chemise Standard", prix: "8.500 FCFA", img: "images/chemise-simple.jpg" }
    ],
    pantalons: [
        { nom: "Pantalon Tissu Simple", prix: "6.000 FCFA", img: "images/pantalon-tissu.jpg" },
        { nom: "Pantalon Tissu Americain", prix: "8.000 FCFA", img: "images/pantalon-americain.jpg" },
        { nom: "Jean Pantalon", prix: "10.000 FCFA", img: "images/jean-pantalon.jpg" }
    ],
    accessoires: [
        { nom: "T-Shirt", prix: "7.000 FCFA", img: "images/tricot.jpg" },
        { nom: "Chaîne Dorée", prix: "8.000 FCFA", img: "images/chaine.jpg" },
        { nom: "Bracelet Luxe", prix: "5.000 FCFA", img: "images/bracelet.jpg" },
        { nom: "Casquette", prix: "4.000 FCFA", img: "images/casquette.jpg" },
        { nom: "Ceinture", prix: "7.000 FCFA", img: "images/ceinture.jpg" },
        { nom: "Lunette de Soleil", prix: "5.000 FCFA", img: "images/lunette.jpg" },
        { nom: "Montre", prix: "25.000 FCFA", img: "images/montre.jpg" },
        { nom: "PorteMonnaie", prix: "7.000 FCFA", img: "images/portemonnaie.jpg" },
        { nom: "Manchette", prix: "5.000 FCFA", img: "images/manchette.jpg" },
        { nom: "Chaussure Homme", prix: "12.000 FCFA", img: "images/chaussure.jpg" },
        { nom: "Cravate & Noeud Papillon", prix: "5.000 FCFA", img: "images/cravatte.jpg" },
        { nom: "Chaussette", prix: "5.000 FCFA", img: "images/chaussette.jpg" }
    ]
};

// ============================================
// PANIER
// ============================================
let cart = [];

// ============================================
// UTILS
// ============================================
function showToast(message) {
    const toast = document.createElement("div");
    toast.textContent = message;
    toast.style.cssText = `
        position: fixed;
        bottom: 80px;
        right: 20px;
        background: #00c2ff;
        color: white;
        padding: 12px 20px;
        border-radius: 10px;
        z-index: 9999;
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    `;
    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 2000);
}

// ============================================
// SCROLL REVEAL
// ============================================
window.addEventListener('scroll', reveal);

function reveal() {
    document.querySelectorAll('.reveal').forEach(el => {
        const top = el.getBoundingClientRect().top;
        if (top < window.innerHeight - 100) {
            el.classList.add('active');
        }
    });
}

// ============================================
// COUNTERS
// ============================================
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll('.counter').forEach(counter => {
        counter.innerText = '0';

        const update = () => {
            const target = +counter.dataset.target;
            const current = +counter.innerText;
            const step = target / 200;

            if (current < target) {
                counter.innerText = Math.ceil(current + step);
                setTimeout(update, 10);
            } else {
                counter.innerText = target;
            }
        };

        update();
    });
});

// ============================================
// HEADER STICKY
// ============================================
window.addEventListener('scroll', () => {
    document.querySelector('header')
        .classList.toggle('sticky', window.scrollY > 50);
});

// ============================================
// OPEN CATEGORY
// ============================================
function openCategory(cat) {
    const modal = document.getElementById("modal");
    const container = document.getElementById("stockContainer");
    const title = document.getElementById("categoryTitle");

    title.textContent = cat.toUpperCase();
    container.innerHTML = "";

    stock[cat].forEach(article => {
        container.innerHTML += `
            <div class="stock-item" style="display:flex; gap:15px; align-items:center;">
                <img src="${article.img}" style="width:90px;height:90px;object-fit:cover;border-radius:15px;">
                <div style="flex:1;">
                    <h3>${article.nom}</h3>
                    <p>${article.prix}</p>
                    <button class="reserve-btn" onclick="reserve('${article.nom}')">
                        Réserver
                    </button>
                </div>
            </div>
        `;
    });

    modal.style.display = "flex";
}

function closeModal() {
    document.getElementById("modal").style.display = "none";
}

// ============================================
// FIND ARTICLE
// ============================================
function findArticle(name) {
    for (let cat in stock) {
        const found = stock[cat].find(a => a.nom === name);
        if (found) return found;
    }
}

// ============================================
// RESERVE
// ============================================
function reserve(name) {
    const item = findArticle(name);

    if (!item) return;

    cart.push(item);
    updateCart();

    showToast(`${item.nom} ajouté au panier`);
}

// ============================================
// CART
// ============================================
function updateCart() {
    document.getElementById("cartCount").innerText = cart.length;
}

function calculateTotal() {
    return cart.reduce((total, item) => {
        const price = parseInt(item.prix.replace(/\./g, ""));
        return total + price;
    }, 0);
}

// ============================================
// OPEN CART
// ============================================
function openCart() {
    const container = document.getElementById("cartItems");
    container.innerHTML = "";

    if (cart.length === 0) {
        container.innerHTML = "<p>Votre panier est vide.</p>";
    } else {
        cart.forEach((item, i) => {
            container.innerHTML += `
                <div style="display:flex;justify-content:space-between;background:#f5f7fa;padding:10px;margin-bottom:10px;border-radius:10px;">
                    <div><strong>${item.nom}</strong><br>${item.prix}</div>
                    <button onclick="removeItem(${i})">X</button>
                </div>
            `;
        });
    }

    document.getElementById("cartTotal").innerText =
        "Total : " + calculateTotal().toLocaleString() + " FCFA";

    document.getElementById("cartModal").style.display = "flex";
    document.getElementById("modal").classList.add("show");
}

function closeCart() {
    document.getElementById("cartModal").style.display = "none";
}

function removeItem(i) {
    cart.splice(i, 1);
    updateCart();
    openCart();
}

// ============================================
// VALIDATION SIMPLE (CORRIGÉE)
// ============================================
function validateName(name) {
    return name.trim().length >= 2;
}

function validatePhone(phone) {
    return /^[0-9]{8,15}$/.test(phone.trim());
}

// ============================================
// WHATSAPP
// ============================================
function sendWhatsApp() {
    const name = document.getElementById("clientName").value;
    const phone = document.getElementById("clientPhone").value;

    if (!validateName(name) || !validatePhone(phone)) {
        alert("Formulaire invalide");
        return;
    }

    if (cart.length === 0) {
        alert("Panier vide");
        return;
    }

    let msg = `🧧 ANTIMELE\n\n👤 ${name}\n☎️ ${phone}\n\n🛒 Articles:\n`;

    cart.forEach((item, i) => {
        msg += `${i + 1}. ${item.nom} - ${item.prix}\n`;
    });

    msg += `\n💰 Total: ${calculateTotal().toLocaleString()} FCFA`;

    window.open(
        "https://wa.me/22898162626?text=" + encodeURIComponent(msg),
        "_blank"
    );
}