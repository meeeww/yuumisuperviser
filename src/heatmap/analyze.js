var apiKey = "RGAPI-fba0bba2-4876-41b9-8541-e2e8460c3a20"

var playerName = "zaskf"
var region = "euw1"
var regionPartidas = "europe"
var tipoPartidas = "ranked"
var numeroPartidas = 5
var checkearPosicion = true //Si está en 1, la línea de abajo servirá
var posicion = "UTILITY" //TOP/JUNGLE/MIDDLE/BOTTOM/UTILITY
var minutosPartida = 10

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

        const resPartidas = await fetch("https://" + regionPartidas + ".api.riotgames.com/lol/match/v5/matches/by-puuid/" + playerId + "/ids?type=" + tipoPartidas + "&start=0&count=" + numeroPartidas + "&api_key=" + apiKey)
        const partidas = await resPartidas.json()

        for (let x = 0; x < partidas.length; x++) {
            const resCheckear = await fetch("https://" + regionPartidas + ".api.riotgames.com/lol/match/v5/matches/" + partidas[x] + "?api_key=" + apiKey)
            const checkear = await resCheckear.json()
            const resTimeline = await fetch("https://" + regionPartidas + ".api.riotgames.com/lol/match/v5/matches/" + partidas[x] + "/timeline?api_key=" + apiKey)
            const timeline = await resTimeline.json()
            //const timeline = await client.matches.fetchMatchTimeline(partidas[x])
            //console.log(partidas[x])
            //console.log(checkear.teams.get("blue").participants[1].summoner)//.client.id
            //console.log()
            //timeline.frames.forEach(evento => console.log(evento));


            lado = "ninguno"

            for (let y = 0; y < 10; y++) {

                if (checkear["info"]["participants"][y]["puuid"] == playerId) {
                    ladoN = y
                    if (ladoN >= 0 && ladoN <= 4) {
                        lado = "blue"
                    }
                    if (ladoN >= 5 && ladoN <= 9) {
                        lado = "red"
                    }
                    numero = 0
                }
            }
            for (let y = 0; y < 10; y++) {
                if (timeline["info"]["participants"][y]["puuid"] == playerId) {
                    console.log(checkearPosicion)
                    console.log("hola")
                    if (checkearPosicion) {
                        console.log("activado")
                        console.log(checkearPosicion)
                        if (checkear["info"]["participants"][y]["individualPosition"] == posicion) {
                            timeline["info"]["frames"].forEach(evento => {
                                if (lado == "blue") {
                                    puntosblue.push([numero, evento["participantFrames"][y]["position"]["x"], evento["participantFrames"][y]["position"]["y"]])
                                }
                                else if (lado == "red") {
                                    puntosred.push([numero, evento["participantFrames"][y]["position"]["x"], evento["participantFrames"][y]["position"]["y"]])
                                }

                                numero += 1
                            });
                        }
                    }
                } else if (!checkearPosicion) {
                    console.log("desactivado")
                    console.log(checkearPosicion)
                    timeline["info"]["frames"].forEach(evento => {
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

        domain = {
            min: { x: -120, y: -120 },
            max: { x: 14870, y: 14980 }
        }
        width = 512
        height = 512
        bg = "https://s3-us-west-1.amazonaws.com/riot-developer-portal/docs/map11.png"
        var xScale, yScale, svg;

        color = d3.scale.linear()
            .domain([0, 3])
            .range(["white", "steelblue"])
            .interpolate(d3.interpolateLab);

        xScale = d3.scale.linear()
            .domain([domain.min.x, domain.max.x])
            .range([0, width]);

        yScale = d3.scale.linear()
            .domain([domain.min.y, domain.max.y])
            .range([height, 0]);

        svg = d3.select("#mapBlue").append("svg:svg")
            .attr("width", width)
            .attr("height", height);

        svg.append('image')
            .attr('xlink:href', bg)
            .attr('x', '0')
            .attr('y', '0')
            .attr('width', width)
            .attr('height', height);

        svg.append('svg:g').selectAll("circle")
            .data(puntosblue)
            .enter().append("svg:circle")
            .attr('cx', function (d) { return xScale(d[1]) })
            .attr('cy', function (d) { return yScale(d[2]) })
            .attr('r', 5)
            .attr('class', 'kills');
        ///////
        domain = {
            min: { x: -120, y: -120 },
            max: { x: 14870, y: 14980 }
        }
        width = 512
        height = 512
        bg = "https://s3-us-west-1.amazonaws.com/riot-developer-portal/docs/map11.png"
        var xScale, yScale, svg;

        color = d3.scale.linear()
            .domain([0, 3])
            .range(["white", "steelblue"])
            .interpolate(d3.interpolateLab);

        xScale = d3.scale.linear()
            .domain([domain.min.x, domain.max.x])
            .range([0, width]);

        yScale = d3.scale.linear()
            .domain([domain.min.y, domain.max.y])
            .range([height, 0]);

        svg = d3.select("#mapRed").append("svg:svg")
            .attr("width", width)
            .attr("height", height);

        svg.append('image')
            .attr('xlink:href', bg)
            .attr('x', '0')
            .attr('y', '0')
            .attr('width', width)
            .attr('height', height);

        svg.append('svg:g').selectAll("circle")
            .data(puntosred)
            .enter().append("svg:circle")
            .attr('cx', function (d) { return xScale(d[1]) })
            .attr('cy', function (d) { return yScale(d[2]) })
            .attr('r', 5)
            .attr('class', 'kills');
    } catch (error) {
        console.log(error)
    }
}

getPlayerId(playerName, region, apiKey)