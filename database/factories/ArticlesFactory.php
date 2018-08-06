<?php

use App\Models\BlogArticle;
use Faker\Generator as Faker;

$antani = [
	'titles' => [
		'Come se fosse antani',
		'Lo vede che stuzzica',
		'Scribai con cofandina',
		'Un pochino antani in prefettura',
		'Allaccia scarpa, scarpallaccia',
		'Nel senso anafestico',
		'Prematurata la supercazzola',
		'Posterdati, per due',
	],
	'paragraphs' => [
		'Ah, pardon. Tarapio tapioco come se fosse Antani, la supercazzola prematurata con dominus reveriscum blinda. Come, prego? Tarapio sulla supercazzola con scappellamento destro o sinistra ? No, no.. non era troppo alto. Forse non ha capito. Io dicevo che se fosse il coso di telefono, o il dito, come se fosse. Andando su o giù, giù o su. Non si intrometta!No, aspetti, mi porga l\'indice; ecco lo alzi così... guardi, guardi, guardi; lo vede il dito? Lo vede che stuzzica, che prematura anche.',
		'Ho provato con la supercazzola con scappellamento paraplegico a sinistra, ma non funzionava, faceva tu-tu. In che senso? Nel senso anafestico. Eh, sì; come farà di capo d\'altitudine, no? Pattene soppaltate secondo l\'articolo 12 abbia pazienza, sennò, posterdati, per due, anche un pochino antani in prefettura...senza contare che la supercazzola prematurata ha perso i contatti col tarapio tapioco. Carmensita, amore mio, sono un uomo d\'affari, blinda la supercazzola prematurata, una cosa d\'assegni, tarapia tapioca, tapioca torapia, dollari, sterline, allaccia scarpa, scarpallaccia, dico d\'albergo, ma tu?',
		'Ma allora io le potrei dire anche con il rispetto per l\'autorità, che anche soltanto le due cose come vice-sindaco, capisce? Mo basta insomma! Qui c’è gente che soffre per davvero, lo capite? Chiamo il medico di turno e domani ve la vedrete con il professore! Mi scusi, Antani come se fosse di scappellamento tarapio tapioco scappellamento di forestieri? Va be\', siete forestieri, ma i cartelli sono internazionali. Mi può mostrare la sua patente, per favore? ',
		'Ma allora io le potrei dire anche con il rispetto per l\'autorità, che anche soltanto le due cose come vice-sindaco, capisce? Vicesindaco? Basta \'osì, mi seguano al commissariato! No, no, no, attenzione, noo! Mi scusi, Antani come se fosse di scappellamento tarapio tapioco scappellamento di forestieri? Va be\', siete forestieri, ma i cartelli sono internazionali. Mi può mostrare la sua patente, per favore?',
		'Si, ma la sbiriguda della sbrindellona come se fosse antani come faceva? Prego? Ho provato con la supercazzola con scappelamento paraplegico a sinistra, ma non funzionava. Non si intrometta!No, aspetti, mi porga l\'indice; ecco lo alzi così... guardi, guardi, guardi; lo vede il dito? Lo vede che stuzzica, che prematura anche. Ma che antifurto, mi faccia il piacere! Questi signori qui stavano sonando loro.',
		'Vicesindaco? Basta \'osì, mi seguano al commissariato! No, no, no, attenzione, noo! Ho capito. Tre applicazioni di afasol, di un’ora l’una. Subito! Che c’è? Ehm.. blinda la supercazzola con scappellamento a sinistra e a destra come se fossero dei pentoloni. Ma che antifurto, mi faccia il piacere! Questi signori qui stavano sonando loro. ',
		'Come se fosse antani anche per lei soltanto in due, oppure in quattro anche scribai con cofandina; come antifurto, per esempio. Guardi, le ho ritagliato quell\'articolo sul Casentino. Ma lei se la blinda la supercazzola prematurata come se fosse anche un po\' di Casentino che perdura anche come cappotto; vede, m\'importa. Ho provato con la supercazzola con scappellamento paraplegico a sinistra, ma non funzionava, faceva tu-tu. In che senso? Nel senso anafestico. Eh, sì; come farà di capo d\'altitudine, no?',
		'Ah, pardon. Tarapio tapioco come se fosse Antani, la supercazzola prematurata con dominus reveriscum blinda. Come, prego? Tarapio sulla supercazzola con scappellamento destro o sinistra ? Si, ma la sbiriguda della sbrindellona come se fosse antani come faceva? Prego? Ho provato con la supercazzola con scappelamento paraplegico a sinistra, ma non funzionava. Si, ma la sbiriguda della sbrindellona come se fosse antani come faceva? Prego? Ho provato con la supercazzola con scappelamento paraplegico a sinistra, ma non funzionava.',
		'Sorella? Eh!? Col tarapia tapioco come se fosse la supercazzola per lei. Voglio il cappellano, il cappellano! Ho visto la Madonna! No, no.. non era troppo alto. Forse non ha capito. Io dicevo che se fosse il coso di telefono, o il dito, come se fosse. Andando su o giù, giù o su. Mi scusi, Antani come se fosse di scappellamento tarapio tapioco scappellamento di forestieri? Va be\', siete forestieri, ma i cartelli sono internazionali. Mi può mostrare la sua patente, per favore?',
		'Ma che antifurto, mi faccia il piacere! Questi signori qui stavano sonando loro. Ho capito. Tre applicazioni di afasol, di un’ora l’una. Subito! Che c’è? Ehm.. blinda la supercazzola con scappellamento a sinistra e a destra come se fossero dei pentoloni. Mo basta insomma! Qui c’è gente che soffre per davvero, lo capite? Chiamo il medico di turno e domani ve la vedrete con il professore!',
		'Mi scusi, Antani come se fosse di scappellamento tarapio tapioco scappellamento di forestieri? Va be\', siete forestieri, ma i cartelli sono internazionali. Mi può mostrare la sua patente, per favore? E lei.. cosa si sente? Professore, non le dico. Antani come trazione per due anche se fosse supercazzola bitumata, ha lo scappellamento a destra. Guardi, le ho ritagliato quell\'articolo sul Casentino. Ma lei se la blinda la supercazzola prematurata come se fosse anche un po\' di Casentino che perdura anche come cappotto; vede, m\'importa.',
		'Mo basta insomma! Qui c’è gente che soffre per davvero, lo capite? Chiamo il medico di turno e domani ve la vedrete con il professore! Vicesindaco? Basta \'osì, mi seguano al commissariato! No, no, no, attenzione, noo! Pattene soppaltate secondo l\'articolo 12 abbia pazienza, sennò, posterdati, per due, anche un pochino antani in prefettura...senza contare che la supercazzola prematurata ha perso i contatti col tarapio tapioco.',
		'Guardi, le ho ritagliato quell\'articolo sul Casentino. Ma lei se la blinda la supercazzola prematurata come se fosse anche un po\' di Casentino che perdura anche come cappotto; vede, m\'importa. Si, ma la sbiriguda della sbrindellona come se fosse antani come faceva? Prego? Ho provato con la supercazzola con scappelamento paraplegico a sinistra, ma non funzionava. No, no.. non era troppo alto. Forse non ha capito. Io dicevo che se fosse il coso di telefono, o il dito, come se fosse. Andando su o giù, giù o su.',
		'E lei.. cosa si sente? Professore, non le dico. Antani come trazione per due anche se fosse supercazzola bitumata, ha lo scappellamento a destra. Vicesindaco? Basta \'osì, mi seguano al commissariato! No, no, no, attenzione, noo! Guardi, le ho ritagliato quell\'articolo sul Casentino. Ma lei se la blinda la supercazzola prematurata come se fosse anche un po\' di Casentino che perdura anche come cappotto; vede, m\'importa.',
		'Pattene soppaltate secondo l\'articolo 12 abbia pazienza, sennò, posterdati, per due, anche un pochino antani in prefettura...senza contare che la supercazzola prematurata ha perso i contatti col tarapio tapioco. Guardi, le ho ritagliato quell\'articolo sul Casentino. Ma lei se la blinda la supercazzola prematurata come se fosse anche un po\' di Casentino che perdura anche come cappotto; vede, m\'importa. Sorella? Eh!? Col tarapia tapioco come se fosse la supercazzola per lei. Voglio il cappellano, il cappellano! Ho visto la Madonna!',
		'Ma che antifurto, mi faccia il piacere! Questi signori qui stavano sonando loro. E lei.. cosa si sente? Professore, non le dico. Antani come trazione per due anche se fosse supercazzola bitumata, ha lo scappellamento a destra. Non si intrometta!No, aspetti, mi porga l\'indice; ecco lo alzi così... guardi, guardi, guardi; lo vede il dito? Lo vede che stuzzica, che prematura anche.',
	]
];

$factory->define(BlogArticle::class, function (Faker $faker) use ($antani) {
	$title = array_random($antani['titles']);
	$excerpt = array_random($antani['paragraphs']);
	$content = $excerpt . '<br>' . array_random($antani['paragraphs']);

	return [
		'published' => TRUE,
		'title' => $title,
		'slug' => str_slug($title),
		'excerpt' => $excerpt,
		'content' => $content
	];
});