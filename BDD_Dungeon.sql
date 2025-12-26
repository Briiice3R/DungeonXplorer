-- phpMyAdmin SQL Dump
-- version 5.2.1deb1+deb12u1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : sam. 27 déc. 2025 à 00:18
-- Version du serveur : 10.11.14-MariaDB-0+deb12u2
-- Version de PHP : 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dx07_bd`
--

-- --------------------------------------------------------

--
-- Structure de la table `Armor`
--

CREATE TABLE `Armor` (
  `item_id` int(11) NOT NULL,
  `protection` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `Armor`
--

INSERT INTO `Armor` (`item_id`, `protection`) VALUES
(8, 20.00),
(9, 50.00),
(10, 100.00),
(11, 20.00),
(12, 60.00);

-- --------------------------------------------------------

--
-- Structure de la table `Chapter`
--

CREATE TABLE `Chapter` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `Chapter`
--

INSERT INTO `Chapter` (`id`, `title`, `description`, `image`) VALUES
(1, 'Acte I : La traversée de la forêt - Introduction', 'Le ciel est lourd ce soir sur le village du Val Perdu, dissimulé entre les montagnes. La petite taverne, dernier refuge avant l’immense forêt, est étrangement calme quand le bourgmestre s’approche de vous. Homme d’apparence usée par les années et les soucis, il vous adresse un regard désespéré. « Ma fille… elle a disparu dans la forêt. Personne n’a osé la chercher… sauf vous, peut-être ? On raconte qu’un sorcier vit dans un château en ruine, caché au cœur des bois. Depuis des mois, des jeunes filles disparaissent… J’ai besoin de vous pour la retrouver. » Vous sentez le poids de la mission qui s’annonce, et un frisson parcourt votre échine. Bientôt, la forêt s’ouvre devant vous, sombre et menaçante. La quête commence.', 'resources/images/chapter1.jpg'),
(2, 'L’orée de la forêt', 'Vous franchissez la lisière des arbres, la pénombre de la forêt avalant le sentier devant vous. Un vent froid glisse entre les troncs, et le bruissement des feuilles ressemble à un murmure menaçant. Deux chemins s’offrent à vous : l’un sinueux, bordé de vieux arbres noueux ; l’autre droit, mais envahi par des ronces épaisses.', 'resources/images/chapter2.jpg'),
(3, 'L’arbre aux corbeaux', 'Votre choix vous mène devant un vieux chêne aux branches tordues, grouillant de corbeaux noirs qui vous observent en silence. À vos pieds, des traces de pas légers, probablement récents, mènent plus loin dans les bois. Soudain, un bruit de pas feutrés se fait entendre. Vous ressentez la présence d’un prédateur.', 'resources/images/chapter3.jpg'),
(4, 'Le sanglier enragé', 'En progressant, le calme de la forêt est soudain brisé par un grognement. Surgissant des buissons, un énorme sanglier, au pelage épais et aux yeux injectés de sang, se dirige vers vous. Sa rage est palpable, et il semble prêt à en découdre. Le voici qui décide brutalement de vous charger !', 'resources/images/chapter4.jpg'),
(5, 'Rencontre avec le paysan', 'Tandis que vous progressez, une voix humaine s’élève, interrompant le silence de la forêt. Vous tombez sur un vieux paysan, accroupi près de champignons aux couleurs vives. Il sursaute en vous voyant, puis se détend, vous souriant tristement. « Vous devriez faire attention, étranger, murmure-t-il. La nuit, des cris terrifiants retentissent depuis le cœur de la forêt… des créatures rôdent. »', 'resources/images/chapter5.jpg'),
(6, 'Le loup noir', 'À mesure que vous avancez, un bruissement attire votre attention. Une silhouette sombre s’élance soudainement devant vous : un loup noir aux yeux perçants. Son poil est hérissé et sa gueule laisse entrevoir des crocs acérés. Vous sentez son regard fixé sur vous, prêt à bondir. Le combat est inévitable.', 'resources/images/chapter6.jpg'),
(7, 'La clairière aux pierres anciennes', 'Après votre rencontre, vous atteignez une clairière étrange, entourée de pierres dressées, comme un ancien autel oublié par le temps. Une légère brume rampe au sol, et les ombres des pierres semblent danser sous la lueur de la lune.', 'resources/images/chapter7.jpg'),
(8, 'Les murmures du ruisseau', 'Essoufflé, mais déterminé, vous arrivez près d’un petit ruisseau qui serpente au milieu des arbres. Le chant de l’eau vous apaise quelque peu, mais des murmures étranges semblent émaner de la rive. Vous apercevez des inscriptions anciennes gravées dans une pierre moussue.', 'resources/images/chapter8.jpg'),
(9, 'Au pied du château', 'La forêt se disperse enfin, et devant vous se dresse une colline escarpée. Au sommet, le château en ruine projette une ombre menaçante sous le clair de lune. Les murs effrités et les tours en partie effondrées ajoutent à la sinistre réputation du lieu. Vous sentez que la véritable aventure commence ici, et que l’influence du sorcier n’est peut-être pas qu’une légende…', 'resources/images/chapter9.jpg'),
(10, 'La lumière au bout du néant', 'Le monde se dérobe sous vos pieds, et une obscurité profonde vous enveloppe, glaciale et insondable. Vous ne sentez plus le poids de votre équipement, ni la morsure de la douleur. Juste un vide infini, vous aspirant lentement dans les ténèbres. Alors que vous perdez toute notion du temps, une lueur douce apparaît au loin, vacillante comme une flamme fragile dans l’obscurité. Au fur et à mesure que vous approchez, vous entendez une voix, faible mais bienveillante, qui murmure des mots oubliés, anciens. « Brave âme, votre chemin n’est pas achevé… À ceux qui échouent, une seconde chance est accordée. Mais les caprices du destin exigent un sacrifice. » La lumière s’intensifie, et vous sentez vos forces revenir, mais vos poches sont vides, votre sac allégé de tout trésor. Votre équipement, vos armes, tout a disparu, laissant place à une sensation de vulnérabilité. Lorsque la lumière vous enveloppe, vous ouvrez de nouveau les yeux, retrouvant la terre ferme sous vos pieds. Vous êtes de retour, sans autre possession que votre volonté de reprendre cette quête. Mais cette fois-ci, peut-être, saurez-vous éviter les pièges fatals qui vous ont mené à votre perte.', 'resources/images/chapter10.jpg'),
(11, 'La curiosité tua le chat', 'Qu’avez-vous fait, malheureux !', 'resources/images/chapter11.jpg'),
(12, 'Acte II : Le château du sorcier - L’entrée du château', 'Devant vous se dresse un château en ruine. Les imposantes portes de chêne s’ouvrent lentement dans un grincement sourd, vous invitant à entrer. Vous franchissez le seuil et débouchez dans le couloir principal. L’air y est lourd, presque étouffant, et les murs décrépis semblent chargés d’un passé oublié. Le long du corridor, des armures de chevaliers rouillées se tiennent immobiles, vestiges silencieux d’anciennes batailles. Pourtant, l’une d’elles retient aussitôt votre regard : au milieu de la rouille et de la poussière, elle brille d’un éclat inhabituel, presque doré.', 'resources/images/chapter12.jpg'),
(13, 'L’armure d’or', 'Vous vous arrêtez devant l’armure, captivé par l’éclat doré de son métal. En vous approchant, vous constatez qu’elle est intégralement recouverte d’or, intacte malgré les ravages du temps. Sans la moindre hésitation, vous décidez de l’enfiler. Une fois l’armure sur vous, vous sentez immédiatement sa solidité et la protection qu’elle vous confère.', 'resources/images/chapter13.jpg'),
(14, 'Les quatre couloirs', 'Au terme de ce couloir délabré, vous découvrez une intersection menant à quatre autres passages, tous aussi inquiétants les uns que les autres. Du premier corridor, s’élève une mélodie étrange, douce et envoûtante. Le second est balayé par un courant d’air froid, comme s’il menait vers l’extérieur. Le troisième, plongé dans une obscurité totale, ne laisse même pas deviner la teinte des murs délavés qui l’entourent. Quant au quatrième passage, il semble en meilleur état que les autres, mais quelque chose dans son apparente normalité vous met mal à l’aise.', 'resources/images/chapter14.jpg'),
(15, 'La salle de bal', 'Le couloir s’ouvre sur une vaste salle autrefois somptueuse. D’immenses lustres de diamant jonchent le sol, les fenêtres sont brisées, et les rideaux de soie, déchirés et ternis par le temps, pendent lamentablement. Une partie du plafond s’est effondrée bien avant votre arrivée, laissant entrer une lumière blafarde. Au premier regard, vous pourriez croire que le temps seul est responsable de ce chaos. Pourtant, à mesure que vous avancez dans la salle, le doute s’installe. Les murs portent des traces de brûlures, tout comme les restes du plafond, comme si un terrible affrontement avait eu lieu ici. Votre attention se porte alors sur les grandes portes de la salle : elles sont couvertes de profondes entailles, longues et nombreuses, marques évidentes d’une violence inouïe. Soudain, un bruit sourd résonne, provenant d’une petite pièce attenante à la salle de bal.', 'resources/images/chapter15.jpg'),
(16, 'La sinistre mélodie', 'La porte du cagibi est verrouillée. Autrefois, cette pièce devait servir à entreposer les instruments de musique une fois le bal terminé. Vous vous tenez tout près, tandis que le silence régnait dans la salle. Soudain, une mélodie sinistre s’élève et une scène irréelle se déploie sous vos yeux. La salle retrouve peu à peu sa splendeur d’antan, comme si le temps reculait. Des esprits apparaissent, translucides, et se mettent à danser au rythme d’un violon invisible. Les somptueux lustres de diamant s’illuminent à nouveau, baignant la pièce d’une lumière chaleureuse, tandis que quelques éclats de rire fantomatiques résonnent, transformant l’atmosphère lugubre en un bal spectral envoûtant.', 'resources/images/chapter16.jpg'),
(17, 'Le chevalier fantôme', 'Une heure s’est écoulée depuis le début du bal spectral. Les revenants dansent et s’amusent encore, lorsque soudain les rires se muent en hurlements déchirants. La panique s’empare de la salle et, en un instant, les fantômes disparaissent aussi brutalement qu’ils étaient apparus. L’obscurité et une atmosphère oppressante reprennent leurs droits. Au centre de la pièce, une ombre se matérialise lentement. Un chevalier en armure rouillée se tient immobile, figé comme une statue. Son regard vide se pose sur vous tandis qu’il lève une épée maculée de sang. Il ne fait aucun doute que le combat est inévitable.', 'resources/images/chapter17.jpg'),
(18, 'L’épée du chevalier', 'Le chevalier vaincu laisse choir sa lourde épée sur le sol. Bien qu’émoussée et rouillée, elle conserve assez de tranchant pour infliger des blessures sérieuses à n’importe quel adversaire.', 'resources/images/chapter18.jpg'),
(19, 'La lueur dans les ténèbres', 'Le sol se dérobe brusquement sous vos pas. Une obscurité totale vous engloutit, froide, impénétrable. Le poids de votre équipement disparaît, tout comme la douleur ; il ne reste qu’un néant sans fin, vous attirant inexorablement vers les ténèbres. Le temps n’a plus de sens. Puis, au loin, une faible lueur surgit, tremblante, semblable à la flamme fragile d’une bougie dans la nuit. À mesure que vous vous en approchez, une voix s’élève, douce et ancienne, murmurant des paroles venues d’un autre âge : « Âme courageuse, votre périple ne s’achève pas ici… À ceux qui chutent, une seconde chance est offerte. Mais le destin, capricieux, réclame toujours son dû.» La lumière grandit, une chaleur familière parcourt votre corps, et vos forces renaissent. Pourtant, lorsque vous portez la main à vos poches, elles sont vides. Votre sac est léger, dépouillé de tout trésor. Armes, armure, équipement : tout s’est évanoui, vous laissant nu face au danger, vulnérable comme au premier jour. La clarté vous enveloppe entièrement. Vous rouvrez les yeux et sentez à nouveau la terre ferme sous vos pieds. Vous êtes revenu. Il ne vous reste rien, sinon votre détermination à poursuivre la quête. Cette fois, peut-être, saurez-vous déjouer les pièges mortels qui vous ont conduit à votre chute.', 'resources/images/chapter19.jpg'),
(20, 'Les tours du château', 'Vous vous retrouvez dans les tours du château, où les pierres, rongées par le temps, donnent à l’édifice un aspect dangereusement fragile. Une brise glaciale s’infiltre par les meurtrières, faisant frissonner l’air ambiant. À travers une brèche dans le mur, vous distinguez le village du Val Perdu, minuscule et lointain, et l’idée vous traverse l’esprit que vous pourriez ne jamais revenir vivant de cette aventure. Après un instant de contemplation, vous redescendez du sommet de la tour et atteignez la porte menant aux remparts du château.', 'resources/images/chapter20.jpg'),
(21, 'La muraille brisée', 'Cela fait maintenant une dizaine de minutes que vous progressez le long de la muraille. De larges sections du mur se sont effondrées depuis bien longtemps, et par endroits, la pierre paraît si fragile qu’elle semble à peine capable de supporter le poids d’un homme. Chaque craquement sous vos pas fait naître une tension sourde, et la simple idée d’une chute vous glace le sang. Pourtant, au bout du chemin, une tour se dresse, et nul ne sait quel trésor peut s’y cacher.', 'resources/images/chapter21.jpg'),
(22, 'La chute', 'Un craquement retentit soudain, et le sol se dérobe sous vos pieds. Pendant la longue et effroyable chute, vous regrettez amèrement votre avidité. Vous heurtez le sol dans un fracas terrible.', 'resources/images/chapter22.jpg'),
(23, 'La prison', 'Le long du couloir, des portes rouillées se succèdent, encastrées dans des murs de pierre couverts de symboles gravés, traces silencieuses du passage d’innombrables prisonniers. Dans certaines cellules, des squelettes gisent encore, témoins d’une fin oubliée. Vous débouchez finalement sur un autre couloir, plus sombre encore, si plongé dans l’obscurité que vous devez saisir une torche pour poursuivre votre exploration.', 'resources/images/chapter23.jpg'),
(24, 'Le squelette maudit', 'Un squelette émerge d’une cellule de la prison. Dans sa main droite, il traîne au sol une hallebarde qui résonne sinistrement à chacun de ses pas, tandis que sa main gauche brandit un bouclier de bois orné du blason peint d’une ancienne famille noble. Il vous fixe de son regard vide, puis lève lentement son arme d’un geste menaçant, vous défiant dans un duel à mort.', 'resources/images/chapter24.jpg'),
(25, 'Le prisonnier', 'La torche vacille lorsque vous vous approchez des barreaux. Dans l’ombre de la cellule, un prisonnier au visage émacié relève la tête et vous fait signe de vous taire. « Écoute-moi bien, étranger », murmure-t-il d’une voix rauque. « Le sorcier que vous cherchez n’est pas un simple mage. Sa magie est ancienne, noire, et les murs eux-mêmes obéissent à sa volonté. J’ai vu des hommes disparaître sans un cri, réduits en cendres ou en folie. Si vous poursuivez votre route, protégez votre esprit autant que votre corps… car face à lui, l’épée seule ne suffira pas. »', 'resources/images/chapter25.jpg'),
(26, 'Les armes du squelette', 'Le squelette s’effondra en un tas d’os immobiles, et le silence retomba dans la salle poussiéreuse. Après avoir repris son souffle, vous vous approchez prudemment et examinez ce que votre ennemi a laissé derrière lui. Appuyée contre le mur de pierre, vous découvrez une hallebarde encore solide malgré son âge, sa lame ternie mais équilibrée. À côté, un bouclier en bois cerclé de fer porte les marques d’anciens combats, mais semble capable de vous protéger. Vous saisissez les deux objets, sentant leur poids rassurant entre vos mains : mieux équipé qu’auparavant, vous savez que le prochain choix que vous feriez pourrait décider de votre destin.', 'resources/images/chapter26.jpg'),
(27, 'Le salon', 'Vous franchissez une porte grinçante qui débouche dans un salon décrépit, où des fauteuils éventrés et une table renversée témoignent d’un abandon ancien. L’air y est lourd, chargé d’une odeur de poussière et de cire froide. Sur une étagère branlante, votre regard est attiré par une fiole intacte contenant un liquide rougeoyant : une potion de soin. Vous la prenez et la rangez soigneusement, sentant déjà un regain d’espoir. Au fond de la pièce, un murmure inquiétant s’élève derrière un rideau sombre ; le sorcier est proche. Vous resserrez votre prise sur votre arme, conscient que l’affrontement est imminent et que chaque décision comptera.', 'resources/images/chapter27.jpg'),
(28, 'Le combat contre le sorcier', 'Le rideau tombe lourdement derrière vous, et vous vous retrouvez soudain face à face avec le sorcier maléfique. Drapé dans une robe sombre constellée de symboles inquiétants, il vous fixe de ses yeux luisants, un sourire cruel étirant son visage pâle. Autour de lui, l’air crépite d’une magie oppressante, faisant vaciller les flammes des chandelles noircies. Vous sentez votre cœur battre plus fort, mais vous tenez bon : votre arme est prête, votre esprit concentré. Le sorcier lève lentement sa main noueuse pour invoquer un sort…', 'resources/images/chapter28.jpg'),
(29, 'La mort du sorcier', 'Dans un ultime éclair de lumière, votre coup brise le sortilège et le sorcier s’effondre à genoux, vaincu. Sa voix tremblante résonne encore alors que la vie le quitte : il vous avoue qu’il n’était qu’un serviteur, contraint d’obéir à un puissant démon tapi dans les profondeurs, celui qui ordonne le kidnapping des jeunes filles du Val Perdu afin qu’on les lui amène. Ses yeux se ferment, laissant derrière lui un silence lourd de révélations. À ses côtés, vous ramassez le sceptre noir incrusté de runes, sentant la magie du sorcier encore prisonnière de l’objet. Cette victoire n’est qu’une étape : désormais, vous savez que votre véritable ennemi vous attend ailleurs, et que votre destin vous mène droit vers lui.', 'resources/images/chapter29.jpg'),
(30, 'Acte III : Le village au pied de la montagne - Le départ du château', 'Vous franchissez lentement la grande porte du château, dont les gonds rouillés gémissent une dernière fois derrière vous. L’air extérieur vous semble plus froid, mais aussi plus vivant, comme si le monde reprenait enfin son souffle après la chute du sorcier. Devant vous s’étend le Val Perdu, baigné d’une lumière grise où serpentent plusieurs chemins incertains. Vous ajustez votre équipement, sentant le poids rassurant de vos armes et du sceptre chargé de magie. Le silence est trompeur : vous savez désormais qu’un démon tire les ficelles dans l’ombre, et que votre quête est loin d’être terminée. Une route descend vers la vallée, tandis qu’un sentier étroit s’enfonce vers la forêt. Vous prenez une profonde inspiration… puis faites votre choix, laissant le château derrière vous et votre destin s’ouvrir devant vos pas.', 'resources/images/chapter30.jpg'),
(31, 'Le sentier étroit', 'Vous vous engagez sur le sentier étroit qui s’enfonce sous les arbres, là où la forêt se referme comme une voûte sombre au-dessus de votre tête. Le sol est irrégulier, couvert de racines glissantes et de feuilles humides qui étouffent le bruit de vos pas. Pendant un temps, seul le chant lointain d’un oiseau trouble le silence, et vous progressez en restant sur vos gardes.\r\nPuis, sans prévenir, une brume épaisse commence à ramper entre les troncs, s’enroulant autour de vos jambes avant de gagner votre taille. En quelques instants, la visibilité se réduit à quelques pas à peine. Les arbres deviennent des ombres déformées et chaque craquement semble vous suivre. Vous resserrez votre prise sur votre arme, conscient que la forêt n’est plus seulement un obstacle, mais peut-être un piège. Dans cette brume inquiétante, il faut vous décider : continuer à avancer à l’aveugle ou vous arrêter pour tenter de comprendre ce qui se cache autour de vous.', 'resources/images/chapter31.jpg'),
(32, 'La brume se dissipe', 'Vous poursuivez votre route avec prudence, pas après pas, jusqu’à ce que la brume commence enfin à s’alléger. Elle se déchire lentement, comme un voile que l’on retire à contrecœur, laissant apparaître les troncs massifs et les rochers moussus qui vous entourent. L’air devient plus clair, plus respirable, et vous réalisez que vous êtes arrivés dans une petite clairière baignée d’une lumière pâle. Le silence est revenu, presque apaisant, mais il garde une tension étrange, comme si la forêt vous observait encore. En regardant autour de vous, vous distinguez plusieurs traces au sol et un nouveau chemin qui semble descendre hors des bois. La brume a disparu, mais ce qu’elle cachait pourrait bien influencer votre prochain choix.', 'resources/images/chapter32.jpg'),
(33, 'Le sauvetage', 'Un cri de détresse déchire soudain le silence. La voix d’une jeune fille, étouffée par la brume, résonne entre les arbres. Sans hésiter, vous vous précipitez dans sa direction, votre cœur battant plus vite à chaque pas. À travers le voile blanchâtre, vous apercevez une silhouette frêle luttant pour se dégager, tandis qu’une forme sombre et flottante l’enserre comme une ombre vivante.\r\nVous vous interposez, brandissant votre arme, et l’esprit maléfique se détourne de sa proie pour se jeter sur vous. L’air se glace autour de vous, chargé d’une énergie hostile. Le combat s’engage.', 'resources/images/chapter33.jpg'),
(34, 'La jeune fille', 'Bref mais intense. Vous résistez à l’oppression surnaturelle et frappez au moment décisif, dissipant l’entité dans un souffle glacé qui se perd dans la brume. Libérée, la jeune fille s’effondre en larmes mais saine et sauve. Tandis que la brume se retire lentement, vous comprenez que les serviteurs du démon rôdent encore… La jeune fille vous donne une potion de défense, une potion d’attaque et une potion de soin.', 'resources/images/chapter34.jpg'),
(35, 'La route vers le village', 'Le chemin pavé de vieilles pierres vous conduit peu à peu vers un village blotti au creux de la vallée. À mesure que vous approchez, les silhouettes des maisons se précisent et des signes de vie apparaissent. Vous franchissez finalement l’entrée du village, décidé à vous y mêler aux habitants. Ici, espérez-vous, quelqu’un saura vous renseigner sur le démon qui étend son ombre sur le Val Perdu.', 'resources/images/chapter35.jpg'),
(36, 'La lueur dans les ténèbres', 'Le sol se dérobe brusquement sous vos pas. Une obscurité totale vous engloutit, froide, impénétrable. Le poids de votre équipement disparaît, tout comme la douleur ; il ne reste qu’un néant sans fin, vous attirant inexorablement vers les ténèbres. Le temps n’a plus de sens. Puis, au loin, une faible lueur surgit, tremblante, semblable à la flamme fragile d’une bougie dans la nuit. À mesure que vous vous en approchez, une voix s’élève, douce et ancienne, murmurant des paroles venues d’un autre âge : « Âme courageuse, votre périple ne s’achève pas ici… À ceux qui chutent, une seconde chance est offerte. Mais le destin, capricieux, réclame toujours son dû.» La lumière grandit, une chaleur familière parcourt votre corps, et vos forces renaissent. Pourtant, lorsque vous portez la main à vos poches, elles sont vides. Votre sac est léger, dépouillé de tout trésor. Armes, armure, équipement : tout s’est évanoui, vous laissant nu face au danger, vulnérable comme au premier jour. La clarté vous enveloppe entièrement. Vous rouvrez les yeux et sentez à nouveau la terre ferme sous vos pieds. Vous êtes revenu. Il ne vous reste rien, sinon votre détermination à poursuivre la quête. Cette fois, peut-être, saurez-vous déjouer les pièges mortels qui vous ont conduit à votre chute.', 'resources/images/chapter36.jpg'),
(37, 'L’arrivée au village', 'La silhouette du village se dessine enfin à l’horizon, alors que la nuit commence à tomber. Les maisons aux toits de chaume et aux fenêtres éclairées diffusent une lueur chaleureuse, contrastant avec l’obscurité environnante. Fatigué par votre périple, vous décidez de passer la nuit à l’auberge, profitant d’un repos bien mérité avant de reprendre votre quête.\r\nLe lendemain, le village s’anime sous le soleil : commerçants, enfants et voyageurs s’affairent dans les rues pavées. C’est l’occasion idéale pour recueillir des informations sur le démon qui menace le Val Perdu. Plusieurs choix s’offrent à vous : vous rendre à la taverne pour écouter les ragots des habitants, parcourir le marché et interroger les marchands, ou vous diriger vers la place centrale où les nouvelles se diffusent rapidement. Chaque décision pourrait vous rapprocher ou vous éloigner de la vérité… et du danger qui rôde.', 'resources/images/chapter37.jpg'),
(38, 'La taverne', 'Vous poussez la porte de la taverne, et l’odeur de bois brûlé et de bière tiède vous accueille. Les habitués, assis autour des tables en bois, vous jettent des regards curieux mais méfiants. Vous vous approchez du comptoir et engagez la conversation, demandant si quelqu’un a déjà entendu parler d’un démon rôdant dans le Val Perdu. Un silence lourd tombe sur la pièce. Les visages se ferment, les regards se détournent, et aucun mot ne franchit leurs lèvres. Pourtant, vous sentez dans leur attitude qu’ils savent quelque chose… mais la peur les empêche de parler. Vous comprenez alors que, pour découvrir la vérité, il vous faudra chercher ailleurs.', 'resources/images/chapter38.jpg'),
(39, 'Le marché', 'Vous arpentez le marché animé du village, où les étals débordent de fruits colorés, d’épices parfumées et d’objets en tout genre. L’agitation et le brouhaha des habitants créent un contraste frappant avec la tension de votre quête. Après avoir parcouru plusieurs étals, vous achetez une potion de mana, sentant déjà l’énergie magique que vous pourrez en retirer.\r\nAlors que vous continuez votre route, votre regard est attiré par un commerçant derrière son étal, qui semble particulièrement craintif. Ses yeux s’écartent à peine de vous, et vous devinez qu’il cache peut-être quelque chose d’important. Vous hésitez : tenter de l’approcher pour obtenir des informations, ou vous rendre à la place centrale du village, où les nouvelles et les rumeurs circulent librement. Chacune de ces décisions pourrait changer le cours de votre quête.', 'resources/images/chapter39.jpg'),
(40, 'Le marchand', 'Vous vous approchez prudemment du marchand, qui vous jette un regard méfiant avant de baisser légèrement sa garde. Après quelques échanges prudents, il finit par parler à voix basse, comme pour ne pas être entendu. Il vous informe avec gravité que tous les villages de la région sont touchés par le même fléau : les disparitions de jeunes filles. Malgré de nombreuses expéditions de recherche organisées par les habitants et les autorités locales, aucune des disparues n’a jamais été retrouvée. Ses mots vous frappent comme un couperet : le danger est plus vaste que vous ne l’aviez imaginé, et la menace du démon semble s’étendre bien au-delà du Val Perdu.', 'resources/images/chapter40.jpg'),
(41, 'La place centrale', 'Vous vous dirigez vers la place centrale du village, où l’agitation est à son comble : marchands, enfants et voyageurs se croisent dans un brouhaha incessant. Vous interrogez plusieurs passants, espérant obtenir des informations sur le démon ou les disparitions, mais les réponses sont vagues et inquiètes. Soudain, un cri strident retentit derrière toi. Vous vous retournez et votre cœur se serre : un chevalier noir tente d’arracher une jeune fille à sa famille, son armure sombre étincelant sous la lumière du jour. Sans réfléchir, vous vous élancez pour vous interposer, prêt à défendre la victime et à affronter cette nouvelle menace qui surgit au cœur même du village.', 'resources/images/chapter41.jpg'),
(42, 'L’épée du chevalier noir', 'Après un combat intense, le chevalier noir se retrouve vaincu. Il tombe au sol, encore en vie, dépourvu de ses bras et de ses jambes. Il s’approche de vous en sautillant et vous menace d’une ultime attaque. Vous l’envoyez valser sans difficulté, d’un léger coup de pied. Puis vous récupérez alors son épée : une lame flambant neuve, parfaitement équilibrée et forgée avec un soin évident. La jeune fille, enfin libre, court rejoindre sa famille en pleurs et en sourires, tandis que les villageois vous regardent avec admiration et soulagement. Le chevalier noir est hors d’état de nuire, mais son épée pourrait bien vous servir dans les épreuves à venir.', 'resources/images/chapter42.jpg'),
(43, 'La bibliothèque', 'Après les événements tumultueux de la place centrale, vous décidez de vous rendre à la bibliothèque du village, un bâtiment ancien aux murs chargés de poussière et de parchemins. L’air y est empreint d’un silence solennel, seulement troublé par le froissement des pages et le craquement des planchers. Vous vous mettez à parcourir les rayonnages, à la recherche de tout ouvrage susceptible de contenir des informations sur le démon qui menace le Val Perdu. Des grimoires oubliés, des manuscrits jaunis et des registres de village s’offrent à vous, chacun portant le potentiel de révéler un indice précieux pour votre quête. Il vous faut maintenant trier ces textes et espérer y trouver la clé qui vous guidera vers la prochaine étape de votre aventure.', 'resources/images/chapter43.jpg'),
(44, 'La porte ensorcelée', 'Vous arrivez devant une porte massive, dont la surface semble vibrer d’une énergie magique. Un sort puissant bloque l’accès : seule la résolution d’une énigme vous permettra de la franchir. Le murmure du vent semble vous chuchoter la question :\r\n« Quel est le résultat de ce calcul : a5 X a3 X a9 »\r\nSeuls les plus attentifs et les plus malins pourront percer le mystère et ouvrir la porte vers ce qui se cache derrière. Il vous faut réfléchir avec soin, car une erreur pourrait vous coûter cher.', 'resources/images/chapter44.jpg'),
(45, 'Le grimoire', 'Après un instant de réflexion, vous donnez la bonne réponse. La porte ensorcelée tremble, puis le sort se dissipe dans un souffle sourd avant de s’ouvrir lentement devant vous. Vous pénétrez dans une pièce circulaire faiblement éclairée, où règne une atmosphère lourde de magie ancienne. Au centre, posé sur un pupitre de pierre, repose un grimoire épais à la couverture sombre, couvert de symboles inquiétants.\r\nEn tournant ses pages avec précaution, vous découvrez des écrits interdits révélant enfin la vérité. Le livre décrit le démon que vous poursuivez, ainsi que sa localisation : une montagne reculée, au cœur d’un ancien sanctuaire corrompu. Plus troublant encore, le grimoire explique son pouvoir le plus redoutable : il est capable de transformer les jeunes filles en monstre surpuissant, afin de se constituer une armée redoutable. Refermant l’ouvrage, vous comprenez que le temps presse. Désormais, vous savez où se trouve votre ennemi… et ce qu’il est capable de faire.', 'resources/images/chapter45.jpg'),
(46, 'La doyenne du village', 'Une vieille femme au regard perçant vous observe longuement avant de s’approcher d’un pas pressé. Sans détour, elle entreprend de vous raconter l’histoire du démon qui hante la montagne. Après une profonde inspiration, sa voix tremblante se fait grave : autrefois, ce démon était un seigneur régnant sur le Val Perdu. Tyrannique et avide, il opprimait son peuple afin d’amasser toujours plus d’or et d’étendre son pouvoir sur son fief.\r\nUn jour, poussé par une soif insatiable de richesse et de puissance, il décida de pactiser avec le diable. En échange d’une magie immense, il accepta de devenir un démon voué à exécuter ses ordres et à semer la destruction sur Terre. Mais le pacte ne se déroula pas comme prévu. L’ancien seigneur fomenta une mutinerie, parvint à renverser le diable régnant sur les enfers et s’empara de sa place, devenant leur nouveau roi. Depuis lors, il prépare son retour, bien décidé à revenir dans le Val Perdu pour asservir à nouveau ceux qui furent jadis ses sujets.', 'resources/images/chapter46.jpg'),
(47, 'Acte IV : La montagne maudite - Au pied de la montagne', 'Après trois jours de marche éprouvante, vous parvenez enfin au pied de la montagne. Un blizzard furieux balaie les lieux, et l’air glacial vous mord la peau, vous glaçant jusqu’aux os. Devant vous, deux chemins se dessinent. Le premier est un sentier de glace, étroit et dangereux, hérissé de stalagmites acérées qui rendent chaque pas périlleux. Le second paraît bien plus facile d’accès, presque trop accueillant pour être honnête. Face à ce choix, vous savez que votre instinct et votre prudence seront mis à l’épreuve.', 'resources/images/chapter47.jpg'),
(48, 'Le sentier de glace', 'Le sentier de glace se révèle extrêmement glissant, rendant chacun de vos pas incertains. Par instants, les pics sombres des montagnes percent la couverture nuageuse, accentuant l’impression de danger. De longues stalagmites acérées bordent le chemin, prêtes à transpercer quiconque ferait une chute malencontreuse. Après une progression prudente, vous arrivez face à un nouveau choix : l’un des passages mène à une falaise abrupte qu’il faudra escalader, tandis que l’autre vous oblige à traverser un pont de glace à l’apparence dangereusement fragile.', 'resources/images/chapter48.jpg'),
(49, 'Le pont de glace', 'Vous posez le pied sur le pont de glace et vous vous engagez avec précaution. À peine avezvous fait quelques pas qu’un craquement inquiétant résonne sous vos bottes. Ce pont millénaire, usé par le temps et le froid, n’était pas aussi solide qu’il en avait l’air. Soudain, la glace cède. Dans une chute vertigineuse, vous avez juste le temps d’apercevoir, au fond de la crevasse, les pointes des stalagmites scintillant à la lueur de la lune. Puis tout s’accélère, et l’obscurité vous engloutit alors que vous vous écrasez lourdement dans les profondeurs glacées.', 'resources/images/chapter49.jpg'),
(50, 'La falaise', 'Vous entreprenez l’ascension de la falaise abrupte, vous agrippant aux aspérités gelées de la roche tandis que le vent glacé fouette votre visage. Chaque mouvement demande concentration et effort. Soudain, une ombre gigantesque glisse au-dessus de vous, projetée sur la paroi par une lueur lointaine. Elle disparaît presque aussitôt, vous laissant suspendu dans le vide, le cœur serré : quelque chose d’immense rôde dans les hauteurs de la montagne.', 'resources/images/chapter50.jpg'),
(51, 'Le sentier sinueux', 'Après avoir franchi le pied de la montagne, vous arrivez sur un sentier étroit et sinueux qui serpente le long de la montagne. Le vent y souffle en rafales, et la neige efface par endroits toute trace de passage. Très vite, le chemin se divise en deux. L’un s’enfonce dans une galerie sombre creusée dans la roche, d’où s’échappe un souffle d’air froid et inquiétant. L’autre contourne la paroi et continue à l’air libre, exposé au vide mais offrant une meilleure visibilité. Vous vous arrêtez un instant : le choix de votre route pourrait décider de la suite de votre aventure.', 'resources/images/chapter51.jpg'),
(52, 'Le loup de glace', 'Alors que vous avancez avec prudence sur le sentier, un grognement sourd résonne dans le silence gelé. Devant vous émerge un loup de glace, immense, son pelage blanc bleuté se confondant presque avec la neige. Ses yeux brillent d’une lueur glaciale, et chacun de ses pas fait crisser la glace sous ses pattes. L’air devient plus froid encore, comme si la créature elle-même portait le blizzard en elle. Vous comprenez aussitôt qu’il ne vous laissera pas passer sans réagir. Vous vous préparez, rassemblant votre courage et vos forces, conscient que cette rencontre est une nouvelle épreuve imposée par la montagne… et peut-être par le démon qui règne sur ses sommets.', 'resources/images/chapter52.jpg'),
(53, 'Les pièces en or', 'Votre regard est attiré par un éclat inhabituel près d’un amas de rochers recouverts de givre. En vous approchant, vous découvrez plusieurs pièces en or éparpillées dans la neige, anciennes mais encore brillantes malgré le froid. Elles portent des symboles oubliés, sans doute vestiges d’un voyageur malchanceux ou d’une offrande laissée là il y a longtemps. Vous les ramassez une à une, les rangeant soigneusement dans votre bourse. Cette trouvaille inattendue vous redonne un peu d’espoir : même sur cette montagne hostile, la chance peut encore sourire à ceux qui osent avancer.', 'resources/images/chapter53.jpg'),
(54, 'L’escalade d’une paroi de glace', 'Devant vous se dresse une paroi de glace presque verticale, lisse par endroits et striée de fissures scintillantes. Le vent glacial souffle en rafales, rendant chaque prise incertaine. Vous plantez prudemment vos mains et vos pieds, cherchant le moindre appui solide, tandis que la glace craque doucement sous votre poids. La montée est lente et éprouvante, vos muscles brûlent et le froid engourdit vos doigts, mais vous refusez d’abandonner. À chaque mètre gagné, vous vous rapprochez du sommet et de la vérité qui vous attend. Vous savez que le plus dur reste peut-être à venir… mais reculer n’est plus une option.', 'resources/images/chapter54.jpg'),
(55, 'Le corbeau', 'Un corbeau se pose soudainement sur la falaise, battant des ailes avec un cri rauque qui résonne dans le vent glacial. Dans son bec, il tient une bague en or qui scintille à la lumière du soleil, attirant immédiatement votre regard. L’objet semble précieux et pourrait s’avérer utile, mais la paroi sur laquelle il se tient est étroite et glissante. Tenter de récupérer la bague serait tentant… si le risque de chute mortelle n’était pas si élevé. Vous hésitez, conscient que chaque décision ici peut coûter cher.', 'resources/images/chapter55.jpg'),
(56, 'Le sommet de la montagne', 'Après une ascension épuisante, vous atteignez enfin le sommet de la montagne. Le vent hurle autour de toi, balayant la neige et faisant danser les nuages bas sous vos pieds. Depuis cette hauteur vertigineuse, vous pouvez apercevoir l’étendue du Val Perdu, ses vallées et ses villages, petits points perdus dans le blanc éclatant de l’hiver. Mais votre regard est attiré plus loin encore : une silhouette sombre se détache sur la crête opposée, imposante et inquiétante. Le démon que vous poursuivez est proche, et le sommet de la montagne n’est que le début de l’affrontement final. Chaque pas que vous ferez désormais vous rapproche de la confrontation qui décidera du destin du Val Perdu.', 'resources/images/chapter56.jpg'),
(57, 'Le dragon de glace', 'Alors que vous progressez sur le sommet balayé par le vent, un rugissement glacial fend l’air et fait trembler la montagne. Devant vous, surgit un dragon de glace, immense et majestueux, ses écailles scintillant comme des cristaux sous la lumière pâle. Ses yeux bleu saphir vous fixent avec une intelligence inquiétante, et chaque battement de ses ailes soulève un blizzard qui vous fait vaciller. La créature semble protéger quelque chose – ou quelqu’un – et il est clair qu’elle ne vous laissera pas passer sans combat. Vous resserrez votre prise sur votre arme et vous vous préparez à affronter ce gardien légendaire, conscient que le moindre faux pas pourrait être fatal.', 'resources/images/chapter57.jpg'),
(58, 'L’ombre du château', 'En traversant le sommet de la montagne, une silhouette se dessine au loin : le château du démon, imposant et menaçant, se détache contre le ciel gris. Même à cette distance, son aura maléfique se fait sentir, projetant une ombre inquiétante sur les sommets enneigés. Les murs noircis semblent absorber la lumière, et des tours crénelées percent les nuages comme des griffes. Le vent glacial transporte des échos de cris et de rugissements indistincts, rappelant la présence des créatures qui protègent le domaine. Devant vous, le chemin est clair : pour sauver le Val Perdu, il faudra pénétrer dans l’ombre de ce château et affronter le démon qui s’y terre.', 'resources/images/chapter58.jpg'),
(59, 'Les ténèbres glaciales', 'Soudain, le sol se dérobe sous vos pieds et une obscurité totale vous engloutit : froide, impénétrable. Le poids de votre équipement disparaît, la douleur s’évanouit ; il ne reste qu’un néant infini qui vous attire inexorablement. Le temps perd toute signification. Puis, au loin, une faible lueur apparaît, vacillante comme la flamme d’une bougie dans la nuit. En vous en approchant, une voix ancienne murmure, douce et mystérieuse :\r\n« Âme courageuse, votre périple ne s’achève pas ici… À ceux qui tombent, une seconde chance est offerte. Mais le destin, capricieux, réclame toujours son dû. »\r\nLa lumière grandit, une chaleur familière parcourt votre corps, et vos forces renaissent. Pourtant, en portant la main à vos poches, vous découvrez qu’elles sont vides. Votre sac est dépouillé : armes, armure, équipement… tout a disparu, vous laissant nu face au danger, vulnérable comme au premier jour. La clarté vous enveloppe entièrement. Lorsque vous rouvrez les yeux, la terre ferme se fait de nouveau sentir sous vos pieds. Vous êtes revenu. Il ne vous reste rien, si ce n’est la détermination de poursuivre votre quête. Cette fois, peut-être, sauriez-vous déjouer les pièges mortels qui vous ont conduit à votre chute.', 'resources/images/chapter59.jpg'),
(60, 'Acte V : Le château du démon - L’énigme de la porte', 'Vous arrivez devant une porte massive, dont la surface est gravée de runes anciennes et scintillantes d’une lumière étrange. Une énergie magique puissante vous empêche de l’ouvrir par la force : seule la solution d’une énigme vous permettra de passer. Les runes semblent vous observer tandis qu’une voix résonne dans votre tête, claire et autoritaire :\n« Pour franchir ce seuil, réponds correctement : quelle arme portait le sorcier ? »\nVous réalisez que votre esprit doit être précis et rapide : une erreur pourrait refermer la porte pour toujours… ou pire, déclencher un sort redoutable. Le destin du Val Perdu dépend peut-être de votre capacité à résoudre cette énigme et à avancer dans l’antre du démon.', 'resources/images/chapter60.jpg'),
(61, 'Les deux couloirs', 'La porte s’ouvre enfin dans un grincement sinistre, révélant deux couloirs sombres qui s’enfoncent dans le château. L’air est lourd et chargé d’une magie oppressante, et le silence pèse sur vous comme une menace. Le couloir de gauche semble plus étroit et tortueux, bordé de torches vacillantes dont la lumière projette des ombres inquiétantes sur les murs. Celui de droite est plus large, mais des gargouilles de pierre semblent vous fixer, et une aura maléfique s’en dégage. Vous vous arrêtez un instant, conscient que votre choix déterminera la suite de votre aventure… et le danger que vous affronterez.', 'resources/images/chapter61.jpg'),
(62, 'Le dragon', 'Alors que vous avancez prudemment dans le couloir, un souffle brûlant fait vibrer les pierres autour de toi. Devant vous surgit un dragon gigantesque, ses écailles noires étincelant d’une lueur sinistre. Ses yeux brillent d’une intelligence froide et perçante, et un grondement sourd résonne dans tout le château. La créature bloque le passage, ses ailes déployées projetant des ombres menaçantes sur les murs. Chaque pas que vous faites semble éveiller sa colère, et vous comprenez que pour continuer, vous devrez affronter ce gardien légendaire…', 'resources/images/chapter62.jpg'),
(63, 'Un lac de lave', 'Vous arrivez dans une vaste salle éclairée par la lueur rougeoyante d’un lac de lave bouillonnante. La chaleur intense vous frappe immédiatement, et la roche sous vos pieds vibre légèrement sous l’énergie incandescente. Deux ponts de pierre traversent le lac, chacun menant vers l’autre rive, mais aucun ne semble totalement sûr. Le premier est étroit et fissuré, menaçant de s’effondrer sous le moindre faux pas. Le second paraît plus solide, mais sa surface est inclinée et glissante, et vous devinez que le passage demandera vigilance et équilibre. Vous hésitez : chaque choix pourrait décider de votre survie et du succès de votre quête.', 'resources/images/chapter63.jpg'),
(64, 'Le pont de pierre fissuré', 'Le pont en piteux état grince et tremble sous votre poids, chaque pas résonnant comme un avertissement. Les fissures semblent vouloir s’agrandir à chaque mouvement, mais vous avancez avec précaution. Après un effort tendu et concentré, vous atteignez enfin l’autre rive sain et sauf. Le pont est derrière vous, et vous pouvez continuer votre aventure, plus vigilant que jamais face aux dangers qui vous attendent encore dans le château du démon.', 'resources/images/chapter64.jpg'),
(65, 'Le pont s’effondre', 'À peine avez-vous mis le pied sur le pont que vous entendez un craquement sinistre. La pierre, affaiblie par les années et les fissures, cède sous votre poids. Dans un fracas assourdissant, le pont s’effondre, emportant tout sur son passage dans la lave bouillonnante en contrebas. Vous avez à peine le temps de bondir pour vous rattraper à la paroi de la salle, le cœur battant, tandis que les débris tombent dans le feu incandescent. Le chemin derrière vous est désormais détruit, et vous comprenez que chaque pas à venir sera un test de courage et d’équilibre, avec le danger omniprésent sous vos pieds.', 'resources/images/chapter65.jpg'),
(66, 'Le lion flamboyant', 'Alors que vous avancez dans une galerie éclairée par des flammes vacillantes, un rugissement puissant résonne et fait trembler les murs. Devant vous surgit un lion flamboyant, sa crinière composée de flammes dansantes qui projettent des ombres inquiétantes tout autour. Ses yeux, d’un orange incandescent, vous fixent avec une intensité sauvage, et chaque pas qu’il fait laisse derrière lui des traces de feu sur le sol. La créature bloque le passage, et vous comprenez rapidement que pour continuer votre périple dans ce château, vous devrez affronter ce gardien ardent…', 'resources/images/chapter66.jpg'),
(67, 'La salle piégée', 'Vous pénétrez dans une vaste salle aux murs sombres, et immédiatement, vous sentez que quelque chose ne va pas. Le sol est parsemé de dalles inégales, certaines légèrement surélevées ou fissurées, et l’air est lourd, chargé d’une tension invisible. Chaque pas doit être calculé avec soin : un faux mouvement pourrait déclencher un mécanisme mortel. Des flèches, des lames cachées ou des pièges magiques semblent prêts à jaillir à tout instant. Vos sens sont en alerte maximale, car pour traverser cette salle intacte, il vous faudra combiner prudence, observation et sang-froid. Chaque décision ici peut décider de votre survie.', 'resources/images/chapter67.jpg'),
(68, 'Le premier étage du château', 'Après avoir franchi la salle piégée, vous atteignez enfin le premier étage du château. Le couloir est large mais silencieux, et l’atmosphère y est oppressante. Devant vous s’alignent cinq portes massives, chacune gravée de symboles étranges et inquiétants. L’une pourrait conduire à une salle de trésor, une autre à des ennemis redoutables, et une troisième à des secrets liés au démon. Les deux dernières restent un mystère complet. Vous savez que le choix de la porte déterminera la suite de votre aventure : prudence et intuition seront vos meilleurs alliés pour avancer sans tomber dans un piège.', 'resources/images/chapter68.jpg'),
(69, 'L’armure magique', 'Vous choisissez d’ouvrir la première porte et pénétrez dans une petite salle faiblement éclairée par des torches vacillantes. Au centre, sur un piédestal, repose une armure scintillante, forgée dans un métal inconnu et incrustée de runes lumineuses. L’armure semble presque vivante, comme si elle attendait que quelqu’un la revête. En l’enfilant, vous ressentez immédiatement une énergie protectrice parcourir votre corps, renforçant vos forces et améliorant votre résistance aux attaques. Cet équipement pourrait s’avérer déterminant pour affronter les dangers qui vous attendent dans le reste du château et pour vous préparer à la confrontation finale avec le démon.', 'resources/images/chapter69.jpg'),
(70, 'La potion de soin', 'Vous ouvrez la deuxième porte et découvrez une petite alcôve où reposent plusieurs fioles aux couleurs chatoyantes. Votre regard est attiré par une potion rouge éclatante, posée sur un plateau de pierre. En la prenant, vous sentez aussitôt son pouvoir bienveillant : elle restaurera vos forces et guérira vos blessures les plus graves. Cette potion pourrait s’avérer précieuse, surtout après les combats que vous avez déjà menés et ceux qui vous attendent encore. Vous la glissez dans votre besace, conscient qu’elle pourrait faire la différence entre la vie et la mort dans les épreuves à venir.', 'resources/images/chapter70.jpg'),
(71, 'Le bouclier en fer', 'Vous choisissez d’ouvrir la troisième porte et pénétrez dans une salle austère où repose un bouclier massif en fer, posé contre le mur. Son métal est noirci par le temps mais semble incroyablement solide, et des symboles gravés sur sa surface laissent transparaître une magie ancienne. En le saisissant, vous ressentez une protection immédiate, comme si le bouclier pouvait absorber non seulement les coups physiques mais aussi une partie de la magie ennemie. Cet équipement deviendra un allié précieux dans votre combat contre les forces du château et, surtout, face au démon qui vous attend au sommet.', 'resources/images/chapter71.jpg'),
(72, 'La lance en or', 'Vous ouvrez la quatrième porte et découvrez une salle illuminée par une lueur dorée qui semble émaner du sol lui-même. Au centre, sur un piédestal orné de gravures anciennes, repose une lance en or étincelante. Sa pointe est incroyablement affûtée et sa hampe légère mais solide, parfaitement équilibrée. En la saisissant, vous sentez un flux d’énergie parcourir votre bras, comme si l’arme était animée d’une magie protectrice et offensive à la fois. Cette lance pourrait se révéler déterminante pour affronter les créatures du château et, peut-être, pour vaincre le démon qui menace le Val Perdu.', 'resources/images/chapter72.jpg'),
(73, 'L’orc', 'Vous franchissez la cinquième porte et vous vous retrouvez face à un orc massif, ses muscles saillants et sa peau verdâtre tissant une impression de force brute. Son regard rougeoyant se fixe sur toi, et un grognement profond résonne dans la salle. L’orc brandit sa massue avec une puissance dévastatrice, prêt à vous frapper au moindre faux pas. Vous comprenez vite que ce combat sera dangereux : chaque mouvement devra être précis et chaque attaque calculée. La survie dépend de votre habileté, de vos armes et de votre sang-froid face à cette créature redoutable.', 'resources/images/chapter73.jpg'),
(74, 'Les pierres précieuses', 'Après avoir vaincu l’orc, vous explorez la salle et votre regard est attiré par un coffret ouvert, dévoilant plusieurs pierres précieuses étincelantes. Rubis, saphirs et émeraudes reflètent la lumière des torches, projetant des reflets colorés sur les murs. Ces joyaux semblent anciens et d’une valeur inestimable, mais vous sentez aussi qu’ils pourraient renfermer une magie oubliée. Vous les examinez attentivement et décidez d’en emporter quelques-unes, conscient que ces trésors pourraient vous servir à la fois comme moyen de négociation, source de pouvoir ou indice pour résoudre les mystères du château.', 'resources/images/chapter74.jpg');
INSERT INTO `Chapter` (`id`, `title`, `description`, `image`) VALUES
(75, 'Le sous-sol', 'En explorant plus avant le château, vous découvrez un escalier étroit menant vers le soussol. L’air devient humide et lourd, chargé d’une odeur de pierre et de moisissure. Chaque pas résonne dans l’obscurité, accentuant le silence oppressant qui règne dans ce lieu oublié. Au fur et à mesure que vous descendez, la lumière du jour disparaît complètement, remplacée par l’obscurité totale, et vous sentez que des secrets anciens, peut-être dangereux, reposent ici depuis des siècles. Le sous-sol pourrait receler des passages cachés, des pièges ou des indices essentiels pour votre quête… mais chaque pas vous rapproche aussi de nouveaux dangers.', 'resources/images/chapter75.jpg'),
(76, 'Le démon', 'Vous pénétrez enfin dans la salle centrale du château, et l’atmosphère devient immédiatement oppressante. Devant vous se tient le démon, immense et terrifiant, ses yeux brûlant d’un feu surnaturel. Sa présence emplit la pièce d’une énergie maléfique, et l’air lui-même semble se contracter sous son pouvoir. Chaque battement de son cœur invisible résonne dans votre poitrine, et vous savez que c’est l’ultime affrontement. Armé de votre courage, de vos armes et des artefacts que vous avez collectés, vous vous tenez prêt à combattre la créature qui menace le Val Perdu et à décider du destin de votre monde. La bataille finale commence…', 'resources/images/chapter76.jpg'),
(77, 'Le sauvetage des jeunes filles', 'Après un combat acharné contre le démon, vous parvenez enfin à briser sa garde et à le vaincre. Puis, vous ouvrez la salle où sont retenues les jeunes filles. Elles se tiennent derrière des barrières magiques, effrayées mais indemnes. À peine franchis les obstacles que vous les rassurez, et elles se précipitent vers vous, les larmes mêlées de soulagement et de gratitude. Ensemble, vous vous frayez un chemin hors de la salle, contournant les derniers pièges du château. Chaque pas vous rapproche de la liberté et de la victoire sur le démon. Les villageois, lorsqu’ils apprendront votre exploit, auront enfin la paix et la sécurité retrouvée dans le Val Perdu.', 'resources/images/chapter77.jpg'),
(78, 'Le retour au village du Val Perdu', 'Après avoir libéré les jeunes filles et quitté le château, vous entamez le chemin du retour à travers la montagne. Le vent froid semble moins mordant, et la lumière du soleil perce enfin à travers les nuages, éclairant les sommets enneigés. En approchant du village du Val Perdu, vous apercevez les habitants rassemblés sur la place centrale, anxieux mais pleins d’espoir. À votre vue, un murmure d’admiration se répand, et les familles des jeunes filles vous saluent avec reconnaissance et joie. Votre périple, semé de dangers et d’épreuves, touche enfin à sa fin : le village est sauvé, et le Val Perdu peut commencer à guérir des ténèbres qui l’avaient envahi.', 'resources/images/chapter78.jpg'),
(79, 'La défaite', 'Soudain, le sol se dérobe sous vos pieds et une obscurité totale vous engloutit : froide, impénétrable. Le poids de votre équipement disparaît, la douleur s’évanouit ; il ne reste qu’un néant infini qui vous attire inexorablement. Le temps perd toute signification. Puis, au loin, une faible lueur apparaît, vacillante comme la flamme d’une bougie dans la nuit. En vous en approchant, une voix ancienne murmure, douce et mystérieuse :\r\n« Âme courageuse, votre périple ne s’achève pas ici… À ceux qui tombent, une seconde chance est offerte. Mais le destin, capricieux, réclame toujours son dû. »\r\nLa lumière grandit, une chaleur familière parcourt votre corps, et vos forces renaissent. Pourtant, en portant la main à vos poches, vous découvrez qu’elles sont vides. Votre sac est dépouillé : armes, armure, équipement… tout a disparu, vous laissant nu face au danger, vulnérable comme au premier jour. La clarté vous enveloppe entièrement. Lorsque vous rouvrez les yeux, la terre ferme se fait de nouveau sentir sous vos pieds. Vous êtes revenu. Il ne vous reste rien, si ce n’est la détermination de poursuivre votre quête. Cette fois, peut-être, saurez-vous déjouer les pièges mortels qui vous ont conduit à votre chute.', 'resources/images/chapter79.jpg'),
(80, 'Fin', 'Fin', 'resources/images/chapter80.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `Chapter_Choice`
--

CREATE TABLE `Chapter_Choice` (
  `id` int(11) NOT NULL,
  `from_chapter_id` int(11) NOT NULL,
  `to_chapter_id` int(11) NOT NULL,
  `choice_text` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `Chapter_Choice`
--

INSERT INTO `Chapter_Choice` (`id`, `from_chapter_id`, `to_chapter_id`, `choice_text`) VALUES
(2, 2, 3, 'Emprunter le chemin sinueux'),
(3, 2, 4, 'Choisir le sentier couvert de ronces'),
(4, 3, 5, 'Choisir de rester prudent'),
(5, 3, 6, 'Décider d’ignorer les bruits et de poursuivre votre route'),
(6, 4, 8, 'Sanglier vaincu'),
(7, 4, 10, 'Vous êtes mort par le sanglier'),
(8, 5, 7, 'Continuer votre chemin après avoir écouter le paysan'),
(9, 6, 7, 'Loup vaincu'),
(10, 6, 10, 'Vous êtes mort par le loup'),
(11, 7, 8, 'Décider de prendre le sentier couvert de mousse'),
(12, 7, 9, 'Choisir de suivre le chemin tortueux à travers les racines'),
(13, 8, 11, 'Toucher la pierre gravée'),
(14, 8, 9, 'Ignorer cette curiosité et poursuivre votre route'),
(15, 9, 12, 'Entrer dans le château'),
(16, 9, 2, 'Ne pas entrer'),
(17, 10, 1, 'Souhaitez-vous reprendre l’aventure depuis le début ?'),
(18, 11, 10, 'Vous êtes mort'),
(19, 12, 13, 'Votre curiosité l’emporte sur votre prudence'),
(20, 12, 14, 'Choisir d’ignorer l’armure dorée'),
(21, 13, 14, 'Poursuivre votre progression dans le château'),
(22, 14, 15, 'La mélodie éveille votre curiosité, emprunter le premier couloir'),
(23, 14, 20, 'Préférer suivre le courant d’air, prendre le deuxième couloir'),
(24, 14, 23, 'Le courage vous anime, engagez-vous dans le troisième couloir'),
(25, 14, 27, 'La prudence guide vos pas, choisisr le quatrième couloir'),
(26, 15, 14, 'La prudence guide vos pas, rebrousser chemin'),
(27, 15, 16, 'La folie l’emporte sur votre raison'),
(28, 16, 14, 'la prudence vous dicte de partir, rebrousser chemin'),
(29, 16, 17, 'Choisir de rester pour observer le bal des revenants'),
(30, 17, 18, 'Vous avez miraculeusement survécu aux assauts du chevalier'),
(31, 17, 19, 'Vous êtes mort'),
(32, 18, 27, 'Continuer l’aventure après cette rencontre'),
(33, 18, 14, 'Poursuivre l’exploration des couloirs du château'),
(34, 19, 12, 'Reprendre l’aventure depuis le château ?'),
(35, 20, 21, 'Vous rendre sur les remparts'),
(36, 20, 14, 'Revenir aux quatres couloirs'),
(37, 21, 22, 'Votre curiosité l’emporte'),
(38, 21, 14, 'La peur vous gagne, rebrousser rapidement chemin'),
(39, 22, 19, 'Vous avez chuté'),
(40, 23, 24, 'S’engager dans le couloir'),
(41, 23, 25, 'Explorer la prison'),
(42, 23, 14, 'Revenir en arrière'),
(43, 24, 26, 'Squelette vaincu'),
(44, 24, 19, 'Vous êtes mort par le squelette'),
(45, 25, 27, 'Continuer à avancer dans le château'),
(46, 25, 14, 'Revenir aux quatres couloirs'),
(47, 26, 27, 'Continuer votre chemin'),
(48, 27, 28, 'Combattre le sorcier'),
(49, 27, 14, 'Continuer l’exploration'),
(50, 28, 29, 'Sorcier vaincu'),
(51, 28, 19, 'Vous êtes mort par le sorcier'),
(52, 29, 30, 'Que l’aventure continue !'),
(53, 30, 31, 'Emprunter le sentier étroit'),
(54, 30, 35, 'Emprunter la route'),
(55, 31, 32, 'Décider de vous arrêter'),
(56, 31, 33, 'Décider d’avancer'),
(57, 32, 35, 'Rejoindre la route'),
(58, 32, 33, 'Avancer dans la forêt'),
(59, 33, 34, 'Esprit maléfique vaincu'),
(60, 33, 36, 'Vous êtes mort par l’esprit '),
(61, 34, 37, 'Continuer votre chemin'),
(62, 35, 37, 'Continuer votre chemin'),
(63, 36, 30, 'Reprendre l’aventure depuis le château'),
(64, 37, 38, 'Décider d’aller à la taverne'),
(65, 37, 39, 'Décider d’aller au marché'),
(66, 38, 43, 'Chercher des informations à la bibliothèque'),
(67, 39, 40, 'Aller voir le marchand'),
(68, 39, 41, 'Se rendre sur la place centrale'),
(69, 40, 43, 'Rechercher des informations à la bibliothèque'),
(70, 41, 42, 'Chevalier noir vaincu'),
(71, 41, 36, 'Vous êtes mort par le chevalier noir'),
(72, 42, 43, 'Rechercher des informations à la bibliothèque'),
(74, 44, 45, 'Le résultat est a17'),
(75, 44, 36, 'Le résultat est a135'),
(76, 45, 46, 'Sortir de la bibliothèque'),
(77, 46, 47, 'La vraie aventure commence'),
(78, 47, 48, 'Choisiir le sentier de glace'),
(79, 47, 51, 'Choisir le second chemin'),
(80, 48, 50, 'Choisiir la falaise'),
(81, 48, 49, 'Choisir le pont de glace'),
(82, 49, 59, 'Vous êtes mort d’une chute'),
(83, 50, 56, 'Continuer l’ascension'),
(84, 51, 53, 'Choisir la galerie sombre'),
(85, 51, 52, 'Choisir le chemin exposé'),
(86, 52, 54, 'Loup vaincu'),
(87, 52, 59, 'Vous êtes mort par le loup'),
(88, 53, 54, 'Continuez à avancer'),
(89, 54, 55, 'Continuer l’ascension'),
(90, 55, 59, 'Récupérer la bague coûte que coûte'),
(91, 55, 56, 'Ignorer le corbeau'),
(92, 56, 57, 'Continuez d’avancer'),
(93, 57, 58, 'Dragon de glace vaincu'),
(94, 57, 59, 'Vous êtes mort par le dragon de glace'),
(95, 58, 60, 'Entrer dans le château, si vous l’osez'),
(96, 59, 47, 'Reprendre l’aventure depuis la montagne'),
(97, 60, 61, 'Un sceptre'),
(98, 60, 79, 'Une baguette magique'),
(99, 61, 62, 'Choisir le couloir de gauche'),
(100, 61, 66, 'Choisir le couloir de droite'),
(101, 62, 63, 'Dragon vaincu'),
(102, 62, 79, 'Vous êtes mort par le dragon'),
(103, 63, 64, 'Emprunter le pont fissuré'),
(104, 63, 65, 'Emprunter le pont incliné'),
(105, 64, 68, 'Continuer votre chemin'),
(106, 65, 68, 'Continuer votre chemin'),
(107, 66, 67, 'Lion flamboyant vaincu'),
(108, 66, 79, 'Vous êtes mort par le lion flamboyant'),
(109, 67, 68, 'Avancer en évitant les dalles fissurées'),
(110, 67, 79, 'Tenter de traverser la salle en courant pour limiter votre exposition au danger'),
(111, 68, 69, 'Entrer dans la première pièce'),
(112, 68, 70, 'Entrer dans la seconde pièce'),
(113, 68, 71, 'Entrer dans la troisième pièce'),
(114, 68, 72, 'Entrer dans la quatrième pièce'),
(115, 68, 73, 'Entrer dans la cinquième pièce'),
(116, 69, 70, 'Choisir de visiter la seconde pièce'),
(117, 69, 73, 'Choisir de visiter la cinquième pièce'),
(118, 70, 73, 'Choisir de visiter la cinquième pièce'),
(119, 71, 72, 'Choisir de visiter la quatrième pièce'),
(120, 71, 73, 'Choisir de visiter la cinquième pièce'),
(121, 72, 73, 'Choisir de visiter la cinquième pièce'),
(122, 73, 74, 'Orc vaincu'),
(123, 73, 79, 'Vous êtes mort par l’orc'),
(124, 74, 75, 'Poursuivre l’exploration du château'),
(125, 75, 76, 'Poursuivre l’exploration du sous-sol'),
(126, 76, 77, 'Démon vaincu'),
(127, 76, 79, 'Vous êtes mort par le démon'),
(128, 77, 78, 'Rentrer au Val Perdu'),
(129, 78, 80, 'Partir du Val Perdu'),
(130, 79, 60, 'Reprendre l’aventure depuis la montagne'),
(502, 43, 44, 'Continuer à chercher des livres'),
(503, 1, 2, 'Que la quête commence !');

-- --------------------------------------------------------

--
-- Structure de la table `Chapter_item`
--

CREATE TABLE `Chapter_item` (
  `chapter_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Chapter_item`
--

INSERT INTO `Chapter_item` (`chapter_id`, `item_id`) VALUES
(29, 6),
(13, 9),
(18, 2),
(26, 3),
(26, 11),
(34, 18),
(34, 15),
(34, 17),
(40, 16),
(42, 4),
(53, 13),
(69, 10),
(70, 15),
(71, 12),
(72, 5),
(74, 14);

-- --------------------------------------------------------

--
-- Structure de la table `Chapter_Monster`
--

CREATE TABLE `Chapter_Monster` (
  `chapter_id` int(11) NOT NULL,
  `monster_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `Chapter_Monster`
--

INSERT INTO `Chapter_Monster` (`chapter_id`, `monster_id`) VALUES
(4, 2),
(6, 1),
(17, 3),
(24, 4),
(28, 5),
(33, 6),
(41, 7),
(52, 8),
(57, 9),
(62, 9),
(66, 11),
(73, 12),
(76, 13);

-- --------------------------------------------------------

--
-- Structure de la table `Hero`
--

CREATE TABLE `Hero` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `biography` text DEFAULT NULL,
  `xp` decimal(10,2) NOT NULL DEFAULT 0.00,
  `pv` decimal(10,2) NOT NULL,
  `mana` decimal(10,2) NOT NULL,
  `strength` decimal(10,2) NOT NULL,
  `initiative` decimal(10,2) NOT NULL,
  `armor_id` int(11) DEFAULT NULL,
  `primary_weapon_id` int(11) DEFAULT NULL,
  `secondary_weapon_id` int(11) DEFAULT NULL,
  `level` int(11) NOT NULL DEFAULT 1,
  `user_id` int(11) NOT NULL,
  `hero_type_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `Hero`
--

INSERT INTO `Hero` (`id`, `name`, `image`, `biography`, `xp`, `pv`, `mana`, `strength`, `initiative`, `armor_id`, `primary_weapon_id`, `secondary_weapon_id`, `level`, `user_id`, `hero_type_id`, `created_at`) VALUES
(3, 'test', 'resources/images/guerrier.jpg', 'Un rempart d\'acier et de muscles, vivant par l\'épée et protégeant ses alliés au cœur de la mêlée.', 0.00, 300.00, 10.00, 80.00, 20.00, NULL, NULL, NULL, 1, 4, 1, '2025-12-22 01:42:58'),
(4, 'test2', 'resources/images/guerrier.jpg', 'Un rempart d\'acier et de muscles, vivant par l\'épée et protégeant ses alliés au cœur de la mêlée.', 0.00, 300.00, 10.00, 80.00, 20.00, NULL, NULL, NULL, 1, 4, 1, '2025-12-22 02:02:07'),
(5, 'test2', 'resources/images/guerrier.jpg', 'Un rempart d\'acier et de muscles, vivant par l\'épée et protégeant ses alliés au cœur de la mêlée.', 0.00, 300.00, 10.00, 80.00, 20.00, NULL, NULL, NULL, 1, 4, 1, '2025-12-22 02:09:28'),
(6, 'test1', 'resources/images/guerrier.jpg', 'Un rempart d\'acier et de muscles, vivant par l\'épée et protégeant ses alliés au cœur de la mêlée.', 0.00, 300.00, 10.00, 80.00, 20.00, NULL, NULL, NULL, 1, 4, 1, '2025-12-22 23:05:30'),
(7, '123', 'resources/images/guerrier.jpg', 'Un rempart d\'acier et de muscles, vivant par l\'épée et protégeant ses alliés au cœur de la mêlée.', 0.00, 300.00, 10.00, 80.00, 20.00, NULL, NULL, NULL, 1, 10, 1, '2025-12-22 23:11:08'),
(8, '1', 'resources/images/guerrier.jpg', 'Un rempart d\'acier et de muscles, vivant par l\'épée et protégeant ses alliés au cœur de la mêlée.', 0.00, 300.00, 10.00, 80.00, 20.00, NULL, NULL, NULL, 1, 10, 1, '2025-12-22 23:14:08'),
(9, 'test', 'resources/images/guerrier.jpg', 'Un rempart d\'acier et de muscles, vivant par l\'épée et protégeant ses alliés au cœur de la mêlée.', 0.00, 300.00, 10.00, 80.00, 20.00, NULL, NULL, NULL, 1, 4, 1, '2025-12-22 23:26:43'),
(10, 'test', 'resources/images/guerrier.jpg', 'Un rempart d\'acier et de muscles, vivant par l\'épée et protégeant ses alliés au cœur de la mêlée.', 0.00, 300.00, 10.00, 80.00, 20.00, NULL, NULL, NULL, 1, 4, 1, '2025-12-22 23:31:03'),
(11, 'test', 'resources/images/guerrier.jpg', 'Un rempart d\'acier et de muscles, vivant par l\'épée et protégeant ses alliés au cœur de la mêlée.', 0.00, 300.00, 10.00, 80.00, 20.00, NULL, NULL, NULL, 1, 4, 1, '2025-12-22 23:35:51'),
(14, 'Valerius', 'resources/images/guerrier.jpg', 'Un rempart d\'acier et de muscles, vivant par l\'épée et protégeant ses alliés au cœur de la mêlée.', 0.00, 300.00, 10.00, 80.00, 20.00, 9, NULL, 1, 1, 11, 1, '2025-12-23 22:18:38'),
(23, 'guerrier', 'resources/images/guerrier.jpg', 'Un rempart d\'acier et de muscles, vivant par l\'épée et protégeant ses alliés au cœur de la mêlée.', 0.00, 300.00, 10.00, 80.00, 20.00, NULL, NULL, NULL, 1, 22, 1, '2025-12-26 00:13:07'),
(24, 'le voleur', 'resources/images/thief.jpg', 'Une ombre agile qui frappe là où ça fait mal, privilégiant la ruse, le crochetage et les attaques surprises.', 0.00, 300.00, 50.00, 50.00, 50.00, NULL, NULL, NULL, 1, 10, 3, '2025-12-26 11:42:26'),
(25, '1', 'resources/images/guerrier.jpg', 'Un rempart d\'acier et de muscles, vivant par l\'épée et protégeant ses alliés au cœur de la mêlée.', 0.00, 300.00, 10.00, 80.00, 20.00, NULL, NULL, NULL, 1, 10, 1, '2025-12-26 16:22:12'),
(26, '2', 'resources/images/sorcier.jpg', 'Un esprit érudit capable de plier la réalité, déchaînant la puissance des arcanes pour foudroyer ses ennemis.', 0.00, 300.00, 80.00, 10.00, 0.00, NULL, NULL, NULL, 1, 10, 2, '2025-12-26 16:28:28'),
(27, '1', 'resources/images/guerrier.jpg', 'Un rempart d\'acier et de muscles, vivant par l\'épée et protégeant ses alliés au cœur de la mêlée.', 0.00, 300.00, 10.00, 80.00, 20.00, NULL, NULL, NULL, 1, 10, 1, '2025-12-26 16:35:45'),
(28, '1', 'resources/images/thief.jpg', 'Une ombre agile qui frappe là où ça fait mal, privilégiant la ruse, le crochetage et les attaques surprises.', 0.00, 300.00, 50.00, 50.00, 50.00, NULL, NULL, NULL, 1, 10, 3, '2025-12-26 16:36:13'),
(29, '123', 'resources/images/guerrier.jpg', 'Un rempart d\'acier et de muscles, vivant par l\'épée et protégeant ses alliés au cœur de la mêlée.', 0.00, 300.00, 10.00, 80.00, 20.00, NULL, NULL, NULL, 1, 10, 1, '2025-12-26 16:49:56'),
(30, '123', 'resources/images/sorcier.jpg', 'Un esprit érudit capable de plier la réalité, déchaînant la puissance des arcanes pour foudroyer ses ennemis.', 0.00, 300.00, 80.00, 10.00, 0.00, NULL, NULL, NULL, 1, 10, 2, '2025-12-26 16:56:58'),
(32, '123', 'resources/images/guerrier.jpg', 'Un rempart d\'acier et de muscles, vivant par l\'épée et protégeant ses alliés au cœur de la mêlée.', 0.00, 300.00, 10.00, 80.00, 20.00, NULL, NULL, NULL, 1, 10, 1, '2025-12-26 17:00:06'),
(34, '321', 'resources/images/guerrier.jpg', 'Un rempart d\'acier et de muscles, vivant par l\'épée et protégeant ses alliés au cœur de la mêlée.', 0.00, 300.00, 10.00, 80.00, 20.00, NULL, NULL, NULL, 1, 10, 1, '2025-12-26 17:20:22'),
(35, '1', 'resources/images/guerrier.jpg', 'Un rempart d\'acier et de muscles, vivant par l\'épée et protégeant ses alliés au cœur de la mêlée.', 0.00, 300.00, 10.00, 80.00, 20.00, NULL, NULL, NULL, 1, 10, 1, '2025-12-26 17:31:20'),
(36, '1', 'resources/images/guerrier.jpg', 'Un rempart d\'acier et de muscles, vivant par l\'épée et protégeant ses alliés au cœur de la mêlée.', 0.00, 300.00, 10.00, 80.00, 20.00, NULL, NULL, NULL, 1, 10, 1, '2025-12-26 17:36:53'),
(37, '8', 'resources/images/guerrier.jpg', 'Un rempart d\'acier et de muscles, vivant par l\'épée et protégeant ses alliés au cœur de la mêlée.', 0.00, 300.00, 10.00, 80.00, 20.00, NULL, NULL, NULL, 1, 10, 1, '2025-12-26 17:57:39'),
(38, '2', 'resources/images/thief.jpg', 'Une ombre agile qui frappe là où ça fait mal, privilégiant la ruse, le crochetage et les attaques surprises.', 0.00, 300.00, 50.00, 50.00, 50.00, NULL, NULL, NULL, 1, 10, 3, '2025-12-26 18:03:40'),
(39, '2', 'resources/images/guerrier.jpg', 'Un rempart d\'acier et de muscles, vivant par l\'épée et protégeant ses alliés au cœur de la mêlée.', 0.00, 300.00, 10.00, 80.00, 20.00, NULL, NULL, NULL, 1, 10, 1, '2025-12-26 18:16:44'),
(40, '1', 'resources/images/guerrier.jpg', 'Un rempart d\'acier et de muscles, vivant par l\'épée et protégeant ses alliés au cœur de la mêlée.', 0.00, 300.00, 10.00, 80.00, 20.00, NULL, NULL, NULL, 1, 10, 1, '2025-12-26 18:48:13'),
(41, 'Valerius', 'resources/images/thief.jpg', 'Une ombre agile qui frappe là où ça fait mal, privilégiant la ruse, le crochetage et les attaques surprises.', 0.00, 300.00, 50.00, 50.00, 50.00, NULL, NULL, NULL, 1, 10, 3, '2025-12-26 19:04:47'),
(42, '9', 'resources/images/guerrier.jpg', 'Un rempart d\'acier et de muscles, vivant par l\'épée et protégeant ses alliés au cœur de la mêlée.', 0.00, 300.00, 10.00, 80.00, 20.00, NULL, NULL, NULL, 1, 10, 1, '2025-12-26 19:38:25');

-- --------------------------------------------------------

--
-- Structure de la table `Hero_Type`
--

CREATE TABLE `Hero_Type` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `max_pv` decimal(10,2) NOT NULL,
  `max_mana` decimal(10,2) NOT NULL,
  `max_strength` decimal(10,2) NOT NULL,
  `max_initiative` decimal(10,2) NOT NULL,
  `max_items` int(11) NOT NULL DEFAULT 10
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `Hero_Type`
--

INSERT INTO `Hero_Type` (`id`, `name`, `image`, `description`, `max_pv`, `max_mana`, `max_strength`, `max_initiative`, `max_items`) VALUES
(1, 'Guerrier', 'resources/images/guerrier.jpg', 'Un rempart d\'acier et de muscles, vivant par l\'épée et protégeant ses alliés au cœur de la mêlée.', 300.00, 10.00, 80.00, 20.00, 15),
(2, 'Magicien', 'resources/images/sorcier.jpg', 'Un esprit érudit capable de plier la réalité, déchaînant la puissance des arcanes pour foudroyer ses ennemis.', 300.00, 80.00, 10.00, 0.00, 15),
(3, 'Voleur', 'resources/images/thief.jpg', 'Une ombre agile qui frappe là où ça fait mal, privilégiant la ruse, le crochetage et les attaques surprises.', 300.00, 50.00, 50.00, 50.00, 15);

-- --------------------------------------------------------

--
-- Structure de la table `Inventory`
--

CREATE TABLE `Inventory` (
  `hero_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `Inventory`
--

INSERT INTO `Inventory` (`hero_id`, `item_id`, `quantity`) VALUES
(14, 1, 1),
(14, 2, 1),
(14, 9, 3),
(14, 10, 2),
(14, 18, 1),
(42, 2, 1),
(42, 4, 1),
(42, 6, 1),
(42, 9, 1),
(42, 18, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Inventory_Log`
--

CREATE TABLE `Inventory_Log` (
  `id` int(11) NOT NULL,
  `hero_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity_change` int(11) NOT NULL COMMENT 'Positif pour ajout, négatif pour retrait',
  `reason` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Item`
--

CREATE TABLE `Item` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `max_stack_size` int(11) NOT NULL DEFAULT 1,
  `item_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `Item`
--

INSERT INTO `Item` (`id`, `name`, `description`, `max_stack_size`, `item_type_id`) VALUES
(1, 'dague', 'Un petit poignard avec une lame tranchante', 1, 1),
(2, 'épée rouillée', 'Une épée légèrement rouillée', 1, 1),
(3, 'hallebarde', 'une hallebarde de bonne manufacture', 1, 1),
(4, 'épée du chevalier noir', 'Une épée à la lame aiguisée comme une lame de rasoir', 1, 1),
(5, 'lance d\'or', 'Une lance en or serti de pierres précieuses', 1, 1),
(6, 'sceptre', 'Un sceptre magique', 1, 1),
(7, 'épée', 'Une épée tranchante', 1, 1),
(8, 'cotte de maille', 'une épaisse cotte de maille', 1, 2),
(9, 'armure en or', 'une armure en or massif', 1, 2),
(10, 'armure magique', 'une armure constitué d\'un matériaux très résistant', 1, 2),
(11, 'bouclier en bois', 'Un vieux bouclier en bois', 1, 2),
(12, 'bouclier en fer', 'un bouclier extrêmement resistant', 1, 2),
(13, 'pièce d\'or', 'Des pièces d\'une valeur inestimables', 1, 3),
(14, 'pierres précieuses', 'Des pierres précieuses très rare', 1, 3),
(15, 'potion de soin', 'Une potion qui redonne des pv', 1, 4),
(16, 'potion de mana', 'Une potion qui redonne du mana', 1, 4),
(17, 'potion d\'attaque', 'une potion qui augmente l\'attaque', 1, 4),
(18, 'potion de défense', 'une potion qui augmente la défense', 1, 4),
(19, 'baguette magique', 'une baguette magique pour jeter un sort', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Item_Type`
--

CREATE TABLE `Item_Type` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `Item_Type`
--

INSERT INTO `Item_Type` (`id`, `category`) VALUES
(1, 'Arme'),
(2, 'Armure'),
(4, 'potion'),
(3, 'tresor');

-- --------------------------------------------------------

--
-- Structure de la table `Level`
--

CREATE TABLE `Level` (
  `level` int(11) NOT NULL,
  `required_xp` decimal(10,2) NOT NULL,
  `pv_bonus` decimal(10,2) NOT NULL DEFAULT 0.00,
  `mana_bonus` decimal(10,2) NOT NULL DEFAULT 0.00,
  `strength_bonus` decimal(10,2) NOT NULL DEFAULT 0.00,
  `initiative_bonus` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `Level`
--

INSERT INTO `Level` (`level`, `required_xp`, `pv_bonus`, `mana_bonus`, `strength_bonus`, `initiative_bonus`) VALUES
(1, 0.00, 0.00, 0.00, 0.00, 0.00);

-- --------------------------------------------------------

--
-- Structure de la table `Level_History`
--

CREATE TABLE `Level_History` (
  `level` int(11) NOT NULL,
  `hero_id` int(11) NOT NULL,
  `date_level_up` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Monster`
--

CREATE TABLE `Monster` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `pv` decimal(10,2) NOT NULL,
  `mana` decimal(10,2) NOT NULL DEFAULT 0.00,
  `initiative` decimal(10,2) NOT NULL,
  `strength` decimal(10,2) NOT NULL,
  `drop_xp` decimal(10,2) NOT NULL DEFAULT 0.00,
  `monster_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `Monster`
--

INSERT INTO `Monster` (`id`, `name`, `description`, `pv`, `mana`, `initiative`, `strength`, `drop_xp`, `monster_type_id`) VALUES
(1, 'Le loup noir', 'Un loup terrifiant au pelage sombre', 50.00, 0.00, 30.00, 10.00, 15.00, 2),
(2, 'Le sanglier enragé', 'Un sanglier bien énervé', 30.00, 0.00, 20.00, 10.00, 10.00, 1),
(3, 'Le chevalier fantôme', 'Un revenant', 60.00, 15.00, 40.00, 40.00, 30.00, 2),
(4, 'Le squelette maudit', 'Un vieux squelette poussiéreux qui a subit une malédiction', 70.00, 15.00, 40.00, 40.00, 30.00, 1),
(5, 'Le sorcier', 'Un sorcier avec une puissante magie', 100.00, 70.00, 20.00, 30.00, 25.00, 2),
(6, 'L\'esprit démoniaque', 'Un esprit maléfique, vif et rusé', 80.00, 50.00, 20.00, 40.00, 40.00, 1),
(7, 'Le chevalier noir', 'Un chevalier à l\'armure peinte en noir', 150.00, 30.00, 30.00, 70.00, 70.00, 2),
(8, 'Le loup de glace', 'Un loup au pelage givré', 90.00, 20.00, 10.00, 80.00, 75.00, 1),
(9, 'Le dragon de glace', 'Un dragon avec le pouvoir de gelé quiconque ose le défier', 250.00, 50.00, 20.00, 80.00, 100.00, 2),
(10, 'Le dragon', 'Un dragon de feu', 300.00, 50.00, 30.00, 80.00, 120.00, 2),
(11, 'Le lion flamboyant', 'Un lion à la crinière de flamme', 300.00, 50.00, 30.00, 70.00, 120.00, 2),
(12, 'L\'orc', 'Un orc terrifiant', 450.00, 10.00, 40.00, 50.00, 120.00, 2),
(13, 'Le démon', 'Un démon d\'une force terrible', 800.00, 80.00, 70.00, 40.00, 0.00, 3);

-- --------------------------------------------------------

--
-- Structure de la table `Monster_Loot`
--

CREATE TABLE `Monster_Loot` (
  `monster_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `drop_rate` decimal(5,2) NOT NULL DEFAULT 0.00 COMMENT 'Pourcentage de 0 à 100'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `Monster_Loot`
--

INSERT INTO `Monster_Loot` (`monster_id`, `item_id`, `quantity`, `drop_rate`) VALUES
(3, 2, 1, 0.00),
(4, 3, 1, 0.00),
(4, 11, 1, 0.00),
(5, 6, 1, 0.00),
(7, 4, 1, 0.00);

-- --------------------------------------------------------

--
-- Structure de la table `Monster_Type`
--

CREATE TABLE `Monster_Type` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `Monster_Type`
--

INSERT INTO `Monster_Type` (`id`, `name`, `description`) VALUES
(1, 'Monstre_commun', 'Monstre que l\'on peut rencontrer partout'),
(2, 'Boss', 'Monstre de fin d\'acte'),
(3, 'Boss_final', 'Le dernier boss');

-- --------------------------------------------------------

--
-- Structure de la table `Password_Resets`
--

CREATE TABLE `Password_Resets` (
  `user_email` varchar(254) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration_date` datetime NOT NULL,
  `creation_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Password_Resets`
--

INSERT INTO `Password_Resets` (`user_email`, `code_hash`, `expiration_date`, `creation_date`) VALUES
('dungeonxplorer866@gmail.com', '$2y$10$mjesDhMb2kIzPT46yTCf2.Dxu6DwokjyG3eVqLghHKTYkxWr0Hc76', '2025-12-23 12:06:57', '2025-12-23 11:29:03'),
('nathanael.heyberger@etu.unicaen.fr', '$2y$10$7aiqfnsLYSVxvynrN7mDCuLr./Hsn.8H3uUANX9Lo9fZtGTCZCoKe', '2025-12-25 00:38:52', '2025-12-21 20:29:22'),
('nathanael.heyberger@gmail.com', '$2y$10$xXaj8xtqwDw/T4AzGm0fr.wYFnM5pWGo2QVPoTYUu.z6i62pQAX8m', '2025-12-25 17:48:03', '2025-12-25 17:33:03'),
('test.test@test.com', '$2y$10$Bu/RZ83xnr940W3XglS3quYQcZOJatSHoiAb.n1PdRy1qnR5rAkNS', '2025-12-23 11:40:56', '2025-12-23 11:08:35');

-- --------------------------------------------------------

--
-- Structure de la table `Potion`
--

CREATE TABLE `Potion` (
  `item_id` int(11) NOT NULL,
  `effect_type` varchar(50) NOT NULL,
  `effect_value` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `Potion`
--

INSERT INTO `Potion` (`item_id`, `effect_type`, `effect_value`) VALUES
(15, 'soin', 50.00),
(16, 'mana', 30.00),
(17, 'force', 40.00),
(18, 'augmente la défense', 40.00);

-- --------------------------------------------------------

--
-- Structure de la table `Progression`
--

CREATE TABLE `Progression` (
  `hero_id` int(11) NOT NULL,
  `chapter_id` int(11) NOT NULL,
  `start_date` datetime DEFAULT current_timestamp(),
  `end_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `Progression`
--

INSERT INTO `Progression` (`hero_id`, `chapter_id`, `start_date`, `end_date`) VALUES
(11, 58, '2025-12-23 16:21:01', NULL),
(14, 33, '2025-12-27 00:02:10', NULL),
(23, 28, '2025-12-26 03:31:37', NULL),
(24, 1, '2025-12-26 16:19:33', NULL),
(25, 1, '2025-12-26 16:28:20', NULL),
(26, 1, '2025-12-26 16:35:37', NULL),
(27, 1, '2025-12-26 16:36:08', NULL),
(28, 1, '2025-12-26 16:49:45', NULL),
(29, 1, '2025-12-26 16:56:43', NULL),
(30, 1, '2025-12-26 17:00:00', NULL),
(32, 12, '2025-12-26 17:20:14', NULL),
(34, 6, '2025-12-26 17:30:42', NULL),
(35, 4, '2025-12-26 17:31:26', NULL),
(36, 6, '2025-12-26 17:55:19', NULL),
(37, 6, '2025-12-26 18:03:28', NULL),
(38, 1, '2025-12-26 18:14:23', NULL),
(39, 4, '2025-12-26 18:47:48', NULL),
(40, 3, '2025-12-26 19:00:19', NULL),
(41, 3, '2025-12-26 19:35:17', NULL),
(42, 30, '2025-12-27 00:06:13', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `Spell`
--

CREATE TABLE `Spell` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `mana_cost` decimal(10,2) NOT NULL,
  `effect` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `Spell`
--

INSERT INTO `Spell` (`id`, `name`, `description`, `mana_cost`, `effect`) VALUES
(1, 'sort d\'empoisonnement', 'enlève des pv à l\'ennemie', 10.00, 30),
(2, 'sort d\'attaque', 'augmente l\'attaque', 10.00, 20),
(3, 'sort de défense', 'augmente la défense', 10.00, 20),
(4, 'sort de mana', 'redonne du mana', 10.00, 20),
(5, 'sort de soin', 'redonne des pv', 10.00, 20);

-- --------------------------------------------------------

--
-- Structure de la table `Spell_Hero`
--

CREATE TABLE `Spell_Hero` (
  `hero_id` int(11) NOT NULL,
  `spell_id` int(11) NOT NULL,
  `learned_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `Spell_Hero`
--

INSERT INTO `Spell_Hero` (`hero_id`, `spell_id`, `learned_at`) VALUES
(26, 5, '2025-12-26 16:28:28'),
(30, 5, '2025-12-26 16:56:58');

-- --------------------------------------------------------

--
-- Structure de la table `Spell_Log`
--

CREATE TABLE `Spell_Log` (
  `id` int(11) NOT NULL,
  `hero_id` int(11) NOT NULL,
  `spell_id` int(11) NOT NULL,
  `action_type` varchar(50) NOT NULL COMMENT 'learned, forgotten, used',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Treasure`
--

CREATE TABLE `Treasure` (
  `chapter_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `Treasure`
--

INSERT INTO `Treasure` (`chapter_id`, `item_id`, `quantity`) VALUES
(53, 13, 1),
(74, 14, 1);

-- --------------------------------------------------------

--
-- Structure de la table `User`
--

CREATE TABLE `User` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(254) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` enum('male','female','other','prefer_not_to_say') DEFAULT 'prefer_not_to_say',
  `created_at` datetime DEFAULT current_timestamp(),
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `User`
--

INSERT INTO `User` (`id`, `username`, `email`, `password`, `gender`, `created_at`, `admin`) VALUES
(1, 'Nathanael', 'test.test@test.com', '$2y$10$VTghIG2uy.q4MxFY/ZNjM.CPW45cuxJLsGp2k.RP63Ll8BykctLMm', 'prefer_not_to_say', '2025-12-21 12:08:52', 0),
(2, 'Natha', 'nathanael.heyberger@etu.unicaen.fr', '$2y$10$qFL3b76SL4ipOe5urCkR.uuL5m2jKyulD5iWfyKv68bjDRGuYO.wK', 'prefer_not_to_say', '2025-12-21 19:06:35', 0),
(4, 'jayson', 'jayson@gmail.com', '$2y$10$/FwGDt3qGWJzVSaya1t7JeF04nrUbt3sLM7JBNO8lYwqOWtcHE4r6', 'male', '2025-12-21 21:51:36', 0),
(10, 'z', 'z@mail.com', '$2y$10$yqibmeF3gEbSofYfjhR32eXw2Bsubqx.zISNXbccDvF/c9i92JLtm', 'female', '2025-12-22 17:30:18', 0),
(11, 'Administrateur', 'admin.dungeonxplorer@unicaen.fr', '$2y$10$h2ljNzem75lSNwhKaDzVjulDcqcJuxLoydbv5R.5x/uxH2NCXjN5O', 'other', '2025-12-22 23:52:40', 1),
(12, 'Natha1', 'nathanael.hey@test.com', '$2y$10$6k1tkROfjqho6.J2nj0GF.gdjc/B94jAplgv0fe/G0htGlGsUf1QG', 'prefer_not_to_say', '2025-12-23 10:45:36', 0),
(13, 'test', 'dungeonxplorer866@gmail.com', '$2y$10$6OCiv7jJiQoZ3yNHMgpKK.Xy.1J.H2g70z.TVFZM0uJDEUdFnEFoe', 'prefer_not_to_say', '2025-12-23 11:28:54', 0),
(21, 'n', 'nathanael.heyberger@gmail.com', '$2y$10$2HIr9KX09ynIZHot0W2FLefqPCPyWy0y98vTnsyCnbM24uzAeWLHe', 'male', '2025-12-24 22:52:19', 0),
(22, 'zoe', 'zoe@mail.com', '$2y$10$P1cp7Opr9.xjGUDNk5qMj.lHPY5Mg5n4aX8YgeQa90FPL5BzJrCli', 'female', '2025-12-26 00:12:34', 0);

-- --------------------------------------------------------

--
-- Structure de la table `Weapon`
--

CREATE TABLE `Weapon` (
  `item_id` int(11) NOT NULL,
  `damage` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `Weapon`
--

INSERT INTO `Weapon` (`item_id`, `damage`) VALUES
(1, 10.00),
(2, 20.00),
(3, 30.00),
(4, 50.00),
(5, 70.00),
(6, 10.00),
(7, 10.00),
(19, 10.00);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Armor`
--
ALTER TABLE `Armor`
  ADD PRIMARY KEY (`item_id`);

--
-- Index pour la table `Chapter`
--
ALTER TABLE `Chapter`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Chapter_Choice`
--
ALTER TABLE `Chapter_Choice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `from_chapter_id` (`from_chapter_id`),
  ADD KEY `to_chapter_id` (`to_chapter_id`);

--
-- Index pour la table `Chapter_item`
--
ALTER TABLE `Chapter_item`
  ADD KEY `chapter_id_fk` (`chapter_id`),
  ADD KEY `item_id_fk` (`item_id`);

--
-- Index pour la table `Chapter_Monster`
--
ALTER TABLE `Chapter_Monster`
  ADD PRIMARY KEY (`chapter_id`,`monster_id`),
  ADD KEY `monster_id` (`monster_id`);

--
-- Index pour la table `Hero`
--
ALTER TABLE `Hero`
  ADD PRIMARY KEY (`id`),
  ADD KEY `armor_id` (`armor_id`),
  ADD KEY `primary_weapon_id` (`primary_weapon_id`),
  ADD KEY `secondary_weapon_id` (`secondary_weapon_id`),
  ADD KEY `idx_hero_user` (`user_id`),
  ADD KEY `idx_hero_type` (`hero_type_id`),
  ADD KEY `idx_hero_level` (`level`);

--
-- Index pour la table `Hero_Type`
--
ALTER TABLE `Hero_Type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Index pour la table `Inventory`
--
ALTER TABLE `Inventory`
  ADD PRIMARY KEY (`hero_id`,`item_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Index pour la table `Inventory_Log`
--
ALTER TABLE `Inventory_Log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `idx_inventory_log_hero` (`hero_id`),
  ADD KEY `idx_inventory_log_created` (`created_at`);

--
-- Index pour la table `Item`
--
ALTER TABLE `Item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_item_type` (`item_type_id`);

--
-- Index pour la table `Item_Type`
--
ALTER TABLE `Item_Type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category` (`category`);

--
-- Index pour la table `Level`
--
ALTER TABLE `Level`
  ADD PRIMARY KEY (`level`);

--
-- Index pour la table `Level_History`
--
ALTER TABLE `Level_History`
  ADD PRIMARY KEY (`level`,`hero_id`),
  ADD KEY `hero_id` (`hero_id`);

--
-- Index pour la table `Monster`
--
ALTER TABLE `Monster`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_monster_type` (`monster_type_id`);

--
-- Index pour la table `Monster_Loot`
--
ALTER TABLE `Monster_Loot`
  ADD PRIMARY KEY (`monster_id`,`item_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Index pour la table `Monster_Type`
--
ALTER TABLE `Monster_Type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Index pour la table `Password_Resets`
--
ALTER TABLE `Password_Resets`
  ADD PRIMARY KEY (`user_email`);

--
-- Index pour la table `Potion`
--
ALTER TABLE `Potion`
  ADD PRIMARY KEY (`item_id`);

--
-- Index pour la table `Progression`
--
ALTER TABLE `Progression`
  ADD PRIMARY KEY (`hero_id`,`chapter_id`),
  ADD KEY `idx_progression_hero` (`hero_id`),
  ADD KEY `idx_progression_chapter` (`chapter_id`);

--
-- Index pour la table `Spell`
--
ALTER TABLE `Spell`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Spell_Hero`
--
ALTER TABLE `Spell_Hero`
  ADD PRIMARY KEY (`hero_id`,`spell_id`),
  ADD KEY `spell_id` (`spell_id`);

--
-- Index pour la table `Spell_Log`
--
ALTER TABLE `Spell_Log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `spell_id` (`spell_id`),
  ADD KEY `idx_spell_log_hero` (`hero_id`),
  ADD KEY `idx_spell_log_created` (`created_at`);

--
-- Index pour la table `Treasure`
--
ALTER TABLE `Treasure`
  ADD PRIMARY KEY (`chapter_id`,`item_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Index pour la table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `Weapon`
--
ALTER TABLE `Weapon`
  ADD PRIMARY KEY (`item_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Chapter`
--
ALTER TABLE `Chapter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT pour la table `Chapter_Choice`
--
ALTER TABLE `Chapter_Choice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=507;

--
-- AUTO_INCREMENT pour la table `Hero`
--
ALTER TABLE `Hero`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pour la table `Hero_Type`
--
ALTER TABLE `Hero_Type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `Inventory_Log`
--
ALTER TABLE `Inventory_Log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Item`
--
ALTER TABLE `Item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `Item_Type`
--
ALTER TABLE `Item_Type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `Level`
--
ALTER TABLE `Level`
  MODIFY `level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `Monster`
--
ALTER TABLE `Monster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT pour la table `Monster_Type`
--
ALTER TABLE `Monster_Type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `Spell`
--
ALTER TABLE `Spell`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `Spell_Log`
--
ALTER TABLE `Spell_Log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `User`
--
ALTER TABLE `User`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Armor`
--
ALTER TABLE `Armor`
  ADD CONSTRAINT `Armor_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `Item` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `Chapter_Choice`
--
ALTER TABLE `Chapter_Choice`
  ADD CONSTRAINT `Chapter_Choice_ibfk_1` FOREIGN KEY (`from_chapter_id`) REFERENCES `Chapter` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Chapter_Choice_ibfk_2` FOREIGN KEY (`to_chapter_id`) REFERENCES `Chapter` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `Chapter_item`
--
ALTER TABLE `Chapter_item`
  ADD CONSTRAINT `chapter_id_fk` FOREIGN KEY (`chapter_id`) REFERENCES `Chapter` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_id_fk` FOREIGN KEY (`item_id`) REFERENCES `Item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Chapter_Monster`
--
ALTER TABLE `Chapter_Monster`
  ADD CONSTRAINT `Chapter_Monster_ibfk_1` FOREIGN KEY (`chapter_id`) REFERENCES `Chapter` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Chapter_Monster_ibfk_2` FOREIGN KEY (`monster_id`) REFERENCES `Monster` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `Hero`
--
ALTER TABLE `Hero`
  ADD CONSTRAINT `Hero_ibfk_1` FOREIGN KEY (`armor_id`) REFERENCES `Item` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `Hero_ibfk_2` FOREIGN KEY (`primary_weapon_id`) REFERENCES `Item` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `Hero_ibfk_3` FOREIGN KEY (`secondary_weapon_id`) REFERENCES `Item` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `Hero_ibfk_4` FOREIGN KEY (`level`) REFERENCES `Level` (`level`),
  ADD CONSTRAINT `Hero_ibfk_5` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Hero_ibfk_6` FOREIGN KEY (`hero_type_id`) REFERENCES `Hero_Type` (`id`);

--
-- Contraintes pour la table `Inventory`
--
ALTER TABLE `Inventory`
  ADD CONSTRAINT `Inventory_ibfk_1` FOREIGN KEY (`hero_id`) REFERENCES `Hero` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Inventory_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `Item` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `Inventory_Log`
--
ALTER TABLE `Inventory_Log`
  ADD CONSTRAINT `Inventory_Log_ibfk_1` FOREIGN KEY (`hero_id`) REFERENCES `Hero` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Inventory_Log_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `Item` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `Item`
--
ALTER TABLE `Item`
  ADD CONSTRAINT `Item_ibfk_1` FOREIGN KEY (`item_type_id`) REFERENCES `Item_Type` (`id`);

--
-- Contraintes pour la table `Level_History`
--
ALTER TABLE `Level_History`
  ADD CONSTRAINT `Level_History_ibfk_1` FOREIGN KEY (`level`) REFERENCES `Level` (`level`) ON DELETE CASCADE,
  ADD CONSTRAINT `Level_History_ibfk_2` FOREIGN KEY (`hero_id`) REFERENCES `Hero` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `Monster`
--
ALTER TABLE `Monster`
  ADD CONSTRAINT `Monster_ibfk_1` FOREIGN KEY (`monster_type_id`) REFERENCES `Monster_Type` (`id`);

--
-- Contraintes pour la table `Monster_Loot`
--
ALTER TABLE `Monster_Loot`
  ADD CONSTRAINT `Monster_Loot_ibfk_1` FOREIGN KEY (`monster_id`) REFERENCES `Monster` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Monster_Loot_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `Item` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `Potion`
--
ALTER TABLE `Potion`
  ADD CONSTRAINT `Potion_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `Item` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `Progression`
--
ALTER TABLE `Progression`
  ADD CONSTRAINT `Progression_ibfk_1` FOREIGN KEY (`hero_id`) REFERENCES `Hero` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Progression_ibfk_2` FOREIGN KEY (`chapter_id`) REFERENCES `Chapter` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `Spell_Hero`
--
ALTER TABLE `Spell_Hero`
  ADD CONSTRAINT `Spell_Hero_ibfk_1` FOREIGN KEY (`hero_id`) REFERENCES `Hero` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Spell_Hero_ibfk_2` FOREIGN KEY (`spell_id`) REFERENCES `Spell` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `Spell_Log`
--
ALTER TABLE `Spell_Log`
  ADD CONSTRAINT `Spell_Log_ibfk_1` FOREIGN KEY (`hero_id`) REFERENCES `Hero` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Spell_Log_ibfk_2` FOREIGN KEY (`spell_id`) REFERENCES `Spell` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `Treasure`
--
ALTER TABLE `Treasure`
  ADD CONSTRAINT `Treasure_ibfk_1` FOREIGN KEY (`chapter_id`) REFERENCES `Chapter` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Treasure_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `Item` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `Weapon`
--
ALTER TABLE `Weapon`
  ADD CONSTRAINT `Weapon_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `Item` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
