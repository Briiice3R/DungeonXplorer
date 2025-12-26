const { heroData, monsterData, poisoningSpellData, careSpellData, strengthSpellData, manaSpellData, deathChapterData, afterChapterData } = window.gameConfig;

console.log(heroData);
console.log(monsterData);
console.log(poisoningSpellData);
console.log(careSpellData);
console.log(strengthSpellData);
console.log(manaSpellData);
console.log(deathChapterData);
console.log(afterChapterData);
console.log("afterChapterData:", window.gameConfig.afterChapterData);
console.log("deathChapterData:", window.gameConfig.deathChapterData);

// Récupération des éléments DOM
let affichagePvHeros = document.getElementById('pv_heros');
let affichagePvMonstre = document.getElementById('pv_monstre');
let affichageManaHeros = document.getElementById('mana_heros');
let affichageNomMonstre = document.getElementById('nom_monstre');
let affichageForceHeros = document.getElementById('force_heros');
let affichageLog = document.getElementById('affichage_log');
let affichageInitiativeHeros = document.getElementById('initiative_heros');
let affichagePvMaxHeros = document.getElementById('pvMax_heros');

let boutonSortEmpoisonnement = document.getElementById('sort_empoisonnement');
let boutonSortSoin = document.getElementById('sort_soin');
let boutonSortForce = document.getElementById('sort_force');
let boutonSortMana = document.getElementById('sort_mana');
let boutonPotionSoin = document.getElementById('potion_soin');
let boutonPotionForce = document.getElementById('potion_force');
let boutonPotionMana = document.getElementById('potion_mana');
let boutonAttaque = document.getElementById('attaque');

// Initialisation de l'affichage
affichagePvHeros.textContent = heroData.pv;
affichagePvMonstre.textContent = monsterData.pv;
affichageForceHeros.textContent = heroData.strength;
affichageManaHeros.textContent = heroData.mana;
affichageInitiativeHeros.textContent = heroData.initiative;
affichagePvMaxHeros.textContent = heroData.maxPv;
const potionSoin = heroData.inventory.find(item => 
    item.type === 'Potion' && item.effectType === 'soin'
);
const potionForce = heroData.inventory.find(item => 
    item.type === 'Potion' && item.effectType === 'force'
);
const potionMana = heroData.inventory.find(item => 
    item.type === 'Potion' && item.effectType === 'mana'
);

// Mise à jour du texte des boutons
if (potionSoin) {
    boutonPotionSoin.textContent = `${potionSoin.quantity} : ${potionSoin.name} : +${potionSoin.effectValue}pv`;
} else {
    boutonPotionSoin.textContent = "0 : Potion de soin";
    boutonPotionSoin.disabled = true;
}

if (potionForce) {
    boutonPotionForce.textContent = `${potionForce.quantity} : ${potionForce.name} : +${potionForce.effectValue}`;
} else {
    boutonPotionForce.textContent = "0 : Potion de force";
    boutonPotionForce.disabled = true;
}

if (potionMana) {
    boutonPotionMana.textContent = `${potionMana.quantity} : ${potionMana.name} : +${potionMana.effectValue}`;
} else {
    boutonPotionMana.textContent = "0 : Potion de mana";
    boutonPotionMana.disabled = true;
}

// Gestion de l'inventaire (recherche des potions dans l'inventaire)
function getPotionFromInventory(effectType) {
    return heroData.inventory.find(item => 
        item.type === 'Potion' && item.effectType === effectType
    );
}

/**** Fonctions de combat ****/

// Lance une attaque simple sur le monstre
function attaqueSimple() {
    if (monsterData.pv > 0 && heroData.pv > 0) {
        let damage = heroData.strength;
        
        // Ajouter les dégâts de l'arme principale si elle existe
        if (heroData.primaryWeapon) {
            damage += heroData.primaryWeapon.damage;
        }
        
        monsterData.pv -= damage;
        if (monsterData.pv < 0) {
            monsterData.pv = 0;
        }
        affichagePvMonstre.textContent = monsterData.pv;
        affichageLog.textContent = `Vous attaquez pour ${damage} dégâts!`;
        
        verifierFinCombat();
        // Le monstre riposte
        setTimeout(monstreAttaque, 1000);
        
    }
}

// Le monstre lance une attaque simple sur le héros
function monstreAttaque() {
    if (heroData.pv > 0 && monsterData.pv > 0) {
        let damage = monsterData.strength;
        
        // Réduire les dégâts si le héros a une armure
        if (heroData.armor) {
            damage = Math.max(0, damage - heroData.armor.protection);
        }
        
        heroData.pv -= damage;
        if (heroData.pv < 0) {
            heroData.pv = 0;
        }
        affichagePvHeros.textContent = heroData.pv;
        affichageLog.textContent = `Le monstre vous attaque pour ${damage} dégâts!`;
        
        verifierFinCombat();
    }
}

// Lance un sort d'empoisonnement
function lancerSortEmpoisonnement() {
    if (heroData.mana < poisoningSpellData.manaCost) {
        affichageLog.textContent = "Vous n'avez pas assez de mana pour jeter ce sort!";
        return;
    }
    
    if (monsterData.pv > 0 && heroData.pv > 0) {
        heroData.mana -= poisoningSpellData.manaCost;
        monsterData.pv -= poisoningSpellData.effect;
        
        if (monsterData.pv < 0) {
            monsterData.pv = 0;
        }
        
        affichagePvMonstre.textContent = monsterData.pv;
        affichageManaHeros.textContent = heroData.mana;
        affichageLog.textContent = `Sort d'empoisonnement! ${poisoningSpellData.effect} dégâts infligés!`;
        verifierFinCombat();
        setTimeout(monstreAttaque, 1000);
    }
}

// Le monstre lance un sort d'empoisonnement
function monstreLancerSortEmpoisonnement() {
    if (monsterData.mana < poisoningSpellData.manaCost) {
        monstreAttaque();
        return;
    }
    
    if (monsterData.pv > 0 && heroData.pv > 0) {
        monsterData.mana -= poisoningSpellData.manaCost;
        heroData.pv -= poisoningSpellData.effect;
        
        if (heroData.pv < 0) {
            heroData.pv = 0;
        }
        
        affichagePvHeros.textContent = heroData.pv;
        affichageLog.textContent = `Le monstre lance un sort d'empoisonnement! ${poisoningSpellData.effect} dégâts subis!`;
        
        verifierFinCombat();
    }
}

// Lance un sort de soin
function lancerSortSoin() {
    if (heroData.mana < careSpellData.manaCost) {
        affichageLog.textContent = "Vous n'avez pas assez de mana pour jeter ce sort!";
        return;
    }
    
    if (heroData.pv > 0) {
        heroData.mana -= careSpellData.manaCost;
        heroData.pv += careSpellData.effect;
        
        // Ne pas dépasser les PV max
        if (heroData.pv > heroData.maxPv) {
            heroData.pv = heroData.maxPv;
            affichageLog.textContent = "Vos pv sont aux maximum";
            heroData.mana += careSpellData.manaCost;
        }
        else{
        
        affichagePvHeros.textContent = heroData.pv;
        affichageManaHeros.textContent = heroData.mana;
        affichageLog.textContent = `Sort de soin! Vous récupérez ${careSpellData.effect} PV!`;
        
        setTimeout(monstreAttaque, 1000);
    }
    }
}

// Le monstre lance un sort de soin
function monstreLancerSortSoin() {
    if (monsterData.mana < careSpellData.manaCost) {
        monstreAttaque();
        return;
    }
    
    if (monsterData.pv > 0) {
        monsterData.mana -= careSpellData.manaCost;
        monsterData.pv += careSpellData.effect;
        
        if (monsterData.pv > monsterData.maxPv) {
            monsterData.pv = monsterData.maxPv;
        }
        
        affichagePvMonstre.textContent = monsterData.pv;
        affichageLog.textContent = `Le monstre se soigne de ${careSpellData.effect} PV!`;
    }
}

// Lance un sort qui augmente la force
function lancerSortForce() {
    if (heroData.mana < strengthSpellData.manaCost) {
        affichageLog.textContent = "Vous n'avez pas assez de mana pour jeter ce sort!";
        return;
    }
    
    if (monsterData.pv > 0 && heroData.pv > 0) {
        heroData.mana -= strengthSpellData.manaCost;
        heroData.strength += strengthSpellData.effect;
        
        affichageForceHeros.textContent = heroData.strength;
        affichageManaHeros.textContent = heroData.mana;
        affichageLog.textContent = `Sort de force! Votre force augmente de ${strengthSpellData.effect}!`;
        
        setTimeout(monstreAttaque, 1000);
    }
}

//Permet de rédiriger ver le bon chapitre une fois le combat fini
function redirigerVersPage(url) {
    window.location.href = '/DungeonXplorer' + url;
}

// Le monstre lance un sort de force
function monstreLancerSortForce() {
    if (monsterData.mana < strengthSpellData.manaCost) {
        monstreAttaque();
        return;
    }
    
    if (monsterData.pv > 0 && heroData.pv > 0) {
        monsterData.mana -= strengthSpellData.manaCost;
        monsterData.strength += strengthSpellData.effect;
        
        affichageLog.textContent = `Le monstre augmente sa force de ${strengthSpellData.effect}!`;
    }
}

// Lance un sort qui redonne du mana
function lancerSortMana() {
    if (heroData.mana < manaSpellData.manaCost) {
        affichageLog.textContent = "Vous n'avez pas assez de mana pour jeter ce sort!";
        return;
    }
    
    if (heroData.pv > 0) {
        heroData.mana -= manaSpellData.manaCost;
        heroData.mana += manaSpellData.effect;
        
        // Ne pas dépasser le mana max
        if (heroData.mana > heroData.maxMana) {
            heroData.mana = heroData.maxMana;
            affichageLog.textContent = "Votre mana est au maximum";
            heroData.mana += manaSpellData.manaCost;
        }
        else{
        affichageManaHeros.textContent = heroData.mana;
        affichageLog.textContent = `Sort de mana! Vous récupérez ${manaSpellData.effect} mana!`;
        
        setTimeout(monstreAttaque, 1000);
        }
    }
}

// Lance une potion de soin
function lancerPotionSoin() {
    let potion = getPotionFromInventory('soin');
    
    if (!potion || potion.quantity <= 0) {
        affichageLog.textContent = "Vous n'avez plus de potion de soin!";
        return;
    }
    
    if (heroData.pv > 0) {
        potion.quantity--;
        heroData.pv += potion.effectValue;
        
        if (heroData.pv > heroData.maxPv) {
            heroData.pv = heroData.maxPv;
        }
        
        affichagePvHeros.textContent = heroData.pv;
        boutonPotionSoin.textContent = `${potion.quantity} : ${potion.name} : +${potion.effectValue}pv`;
        affichageLog.textContent = `Vous utilisez une ${potion.name}! +${potion.effectValue} PV`;
        
        setTimeout(monstreAttaque, 1000);
    }
}

// Lance une potion de force
function lancerPotionForce() {
    let potion = getPotionFromInventory('force');
    
    if (!potion || potion.quantity <= 0) {
        affichageLog.textContent = "Vous n'avez plus de potion de force!";
        return;
    }
    
    if (heroData.pv > 0) {
        potion.quantity--;
        heroData.strength += potion.effectValue;
        
        affichageForceHeros.textContent = heroData.strength;
        boutonPotionForce.textContent = `${potion.quantity} : ${potion.name} : +${potion.effectValue}`;
        affichageLog.textContent = `Vous utilisez une ${potion.name}! +${potion.effectValue} force`;
        
        setTimeout(monstreAttaque, 1000);
    }
}

// Lance une potion de mana
function lancerPotionMana() {
    let potion = getPotionFromInventory('mana');
    
    if (!potion || potion.quantity <= 0) {
        affichageLog.textContent = "Vous n'avez plus de potion de mana!";
        return;
    }
    
    if (heroData.pv > 0) {
        potion.quantity--;
        heroData.mana += potion.effectValue;
        
        if (heroData.mana > heroData.maxMana) {
            heroData.mana = heroData.maxMana;
        }
        
        affichageManaHeros.textContent = heroData.mana;
        boutonPotionMana.textContent = `${potion.quantity} : ${potion.name} : +${potion.effectValue}`;
        affichageLog.textContent = `Vous utilisez une ${potion.name}! +${potion.effectValue} mana`;
        
        setTimeout(monstreAttaque, 1000);
    }
}

// Vérifie si le combat est terminé
function verifierFinCombat() {
    if (estGagnee()) {
        affichageLog.textContent = `Victoire! Vous avez vaincu ${monsterData.name}! +${monsterData.dropXp} XP`;
        redirigerVersPage(`/chapter/${afterChapterData.id}`);
    } else if (estPerdu()) {
        affichageLog.textContent = "Défaite... Vous avez été vaincu!";
        redirigerVersPage(`/chapter/${deathChapterData.id}`);
    }
}

// Retourne vrai si le héros gagne
function estGagnee() {
    return monsterData.pv == 0;
}

// Retourne vrai si le héros perd
function estPerdu() {
    return heroData.pv == 0;
}

/****** Événements ******/

boutonAttaque.addEventListener('click', () => {
    attaqueSimple();
});

boutonSortEmpoisonnement.addEventListener('click', () => {
    lancerSortEmpoisonnement();
});

boutonSortForce.addEventListener('click', () => {
    lancerSortForce();
});

boutonSortMana.addEventListener('click', () => {
    lancerSortMana();
});

boutonSortSoin.addEventListener('click', () => {
    lancerSortSoin();
});

boutonPotionSoin.addEventListener('click', () => {
    lancerPotionSoin();
});

boutonPotionMana.addEventListener('click', () => {
    lancerPotionMana();
});

boutonPotionForce.addEventListener('click', () => {
    lancerPotionForce();
});