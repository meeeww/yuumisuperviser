import { Client } from 'shieldbow';
const client = new Client('RGAPI-e5ed835f-b8f6-4d71-9374-d8adfe2b8101');

var player = "zaskf"
var checkearPosicion = true //Si está en 1, la línea de abajo servirá
var posicion = "UTILITY" //TOP/JUNGLE/MIDDLE/BOTTOM/UTILITY
var minutosPartida = 10

var numero = 0
var puntosblue = []
var puntosred = []
var lado = "ninguno"

client
	.initialize({
		region: 'euw',
	})
	.then(async () => {
		const summoner = await client.summoners.fetchBySummonerName(player);
		const playerId = await summoner.playerId
		const partidas = await client.matches.fetchMatchListByPlayer(playerId, {
			count: 10,
			type: 'ranked'
		})

		for (let x = 0; x < partidas.length; x++) {
			const checkear = await client.matches.fetch(partidas[x])
			const timeline = await client.matches.fetchMatchTimeline(partidas[x])
			//console.log(partidas[x])
			//console.log(checkear.teams.get("blue").participants[1].summoner)//.client.id
			//console.log()
			//timeline.frames.forEach(evento => console.log(evento));
			lado = "ninguno"
			
			for (let y = 0; y < 5; y++) {

				if (checkear.teams.get("blue").participants[y].summoner.playerId == playerId) {
					lado = "blue"
				} else if (checkear.teams.get("red").participants[y].summoner.playerId == playerId) {
					lado = "red"
				}
				numero = 0
			}
			for (let y = 0; y < 5; y++) {
				if (checkear.teams.get("red").participants[y].summoner.playerId == playerId || checkear.teams.get("blue").participants[y].summoner.playerId == playerId) {
					console.log(checkearPosicion)
					console.log("hola")
					if (checkearPosicion) {
						console.log("activado")
						console.log(checkearPosicion)
						if (checkear.teams.get("blue").participants[y].position["individual"] == posicion) {
							timeline.frames.forEach(evento => {
								if (lado == "blue") {
									puntosblue.push([numero, evento["participantFrames"][y]["position"]["x"], evento["participantFrames"][y]["position"]["y"]])
								}
								else if (lado == "red") {
									puntosred.push([numero, evento["participantFrames"][y]["position"]["x"], evento["participantFrames"][y]["position"]["y"]])
								}
								console.log("problemitas")

								numero += 1
							});
						}
					}
				} else if (!checkearPosicion) {
					console.log("desactivado")
					console.log(checkearPosicion)
					timeline.frames.forEach(evento => {
						if (lado == "blue") {
							puntosblue.push([numero, evento["participantFrames"][y]["position"]["x"], evento["participantFrames"][y]["position"]["y"]])
						} else if (lado == "red") {
							puntosred.push([numero, evento["participantFrames"][y]["position"]["x"], evento["participantFrames"][y]["position"]["y"]])
						}
						numero += 1
					});
				}
			}
		}
		console.log(puntosblue)
		console.log("...")
		console.log(puntosred)
	});