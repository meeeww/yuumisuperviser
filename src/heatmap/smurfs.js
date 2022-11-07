var apiKey = "RGAPI-98932bde-dc08-4245-aec2-e67de686082e"

var playerName = "jude sharp"
var region = "euw1"
var regionPartidas = "europe"
var posicion = "UTILITY" //TOP/JUNGLE/MIDDLE/BOTTOM/UTILITY
var numeroPartidas = 50

var numero = 0
var puntosblue = []
var puntosred = []
var lado = "ninguno"
var ladoN = 0


const getPlayerId = async (playerName, region, apiKey) => {
    try {
        const resId = await fetch("https://" + region + ".api.riotgames.com/lol/summoner/v4/summoners/by-name/" + playerName + "?api_key=" + apiKey)
        const dataId = await resId.json()
        const playerId = await dataId["puuid"]

        const resPartidasRanked = await fetch("https://" + regionPartidas + ".api.riotgames.com/lol/match/v5/matches/by-puuid/" + playerId + "/ids?type=ranked&start=0&count=" + numeroPartidas + "&api_key=" + apiKey)
        const partidasRanked = await resPartidasRanked.json()
        const resPartidasNormal = await fetch("https://" + regionPartidas + ".api.riotgames.com/lol/match/v5/matches/by-puuid/" + playerId + "/ids?type=normal&start=0&count=" + numeroPartidas + "&api_key=" + apiKey)
        const partidasNormal = await resPartidasNormal.json()
        const resPartidasTourney = await fetch("https://" + regionPartidas + ".api.riotgames.com/lol/match/v5/matches/by-puuid/" + playerId + "/ids?type=tourney&start=0&count=" + numeroPartidas + "&api_key=" + apiKey)
        const partidasTourney = await resPartidasTourney.json()

        var partidasTotales = []
        for (var i = 0; i < numeroPartidas; i++){
            if(partidasRanked[i] !== undefined){
                partidasTotales.push(partidasRanked[i])
            }
            if(partidasNormal[i] !== undefined){
                partidasTotales.push(partidasNormal[i])
            }
            if(partidasTourney[i] !== undefined){
                partidasTotales.push(partidasTourney[i])
            }
        
        }

        console.log(partidasTotales)

        var jugadoresJugados = []

        for (let x = 0; x < partidasTotales.length; x++) {
            if(partidasTotales[0][x] !== undefined && partidasTotales[1][x] !== undefined && partidasTotales[2][x] !== undefined){
                const resCheckear = await fetch("https://" + regionPartidas + ".api.riotgames.com/lol/match/v5/matches/" + partidasTotales[x] + "?api_key=" + apiKey)
                const checkear = await resCheckear.json()
            
                console.log(partidasTotales[x])

                checkear["info"]["participants"].forEach(participante => {
                    jugadoresJugados.push(participante["summonerName"])
                })
            }
            
            
        }

        jugadoresJugados.forEach(function (x) {
            //jugadoresJugados[x] = (jugadoresJugados[x] || 0) + 1;
            jugadoresJugados[x] = [jugadoresJugados[x]]

        });

        let amigos = {}

        for(let i =0; i < jugadoresJugados.length; i++){ 
            if (amigos[jugadoresJugados[i]]){
                amigos[jugadoresJugados[i]] += 1
            } else {
                amigos[jugadoresJugados[i]] = 1
            }
            }  
            for (let prop in amigos){
                if (amigos[prop] >= 3){
                    console.log(prop + " counted: " + amigos[prop] + " times.")
                }
            }
        console.log(amigos)

    } catch (error) {
        console.log(error)
    }
}

getPlayerId(playerName, region, apiKey)