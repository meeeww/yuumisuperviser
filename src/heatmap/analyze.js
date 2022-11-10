function analyze() {
    var apiKey = "RGAPI-328602b9-1647-47a3-8266-7481cffcf146"

    var playerName = document.getElementById("summoner").value;
    var region = document.getElementById("region").value;
    var regionPartidas = "europe"
    var tipoPartidas = "ranked"
    var numeroPartidas = document.getElementById("partidas").value;
    var checkearPosicion = true //Si está en 1, la línea de abajo servirá
    var posicion = document.getElementById("position").value; //TOP/JUNGLE/MIDDLE/BOTTOM/UTILITY
    var minutosPartida = document.getElementById("minutosPartida").value;
    var porcentaje = 0

    var numero = 0
    var puntosblue = []
    var puntosred = []
    var lado = "ninguno"
    var ladoN = 0

    switch (region) {
        case "EUW1":
            regionPartidas = "europe"
            break;
        case "EUN1":
            regionPartidas = "europe"
            break;
        case "NA1":
            regionPartidas = "americas"
            break;
        case "BR1":
            regionPartidas = "americas"
            break;
        case "LA1":
            regionPartidas = "americas"
            break;
        case "LA2":
            regionPartidas = "americas"
            break;
        case "JP1":
            regionPartidas = "asia"
            break;
        case "KR":
            regionPartidas = "asia"
            break;
        case "TR1":
            regionPartidas = "asia"
            break;
        case "RU":
            regionPartidas = "asia"
            break;
        case "OC1":
            regionPartidas = "sea"
            break;

    }
    document.getElementById("cajita").style.display = "none";
    document.getElementById("cargando").style.display = "flex";


    document.getElementById("serverTime").innerHTML = porcentaje + "%";

    const getPlayerId = async (playerName, region, apiKey) => {
        console.log(playerName)
        document.getElementById("serverTime").innerHTML = porcentaje + "%";
        try {
            const resId = await fetch("https://" + region + ".api.riotgames.com/lol/summoner/v4/summoners/by-name/" + playerName + "?api_key=" + apiKey)
            const dataId = await resId.json()
            const playerId = await dataId["puuid"]

            const resPartidas = await fetch("https://" + regionPartidas + ".api.riotgames.com/lol/match/v5/matches/by-puuid/" + playerId + "/ids?type=" + tipoPartidas + "&start=0&count=" + numeroPartidas + "&api_key=" + apiKey)
            const partidas = await resPartidas.json()

            for (let x = 0; x < partidas.length; x++) {
                porcentaje = Math.floor((x / partidas.length) * 100)
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
                document.getElementById("serverTime").innerHTML = porcentaje + "%";
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
                document.getElementById("serverTime").innerHTML = porcentaje + "%";
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
                                    } else if (lado == "red") {
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

            document.getElementById("serverTime").innerHTML = porcentaje + "%";

            for (var i = 0; i < minutosPartida; i++) {
                var div = document.createElement("mapBlue" + i);
                document.getElementById("container").appendChild(div);
                div.style.width = "512px";
                div.style.height = "100%";
                div.style.color = "white";
                //div.innerHTML = "Minute " + i + ", BlueSide";
                div.id = "mapBlue" + i

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

                svg = d3.select("#mapBlue" + i).append("svg:svg")
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
                    .attr('cx', function (d) {
                        if (d[0] == i) {
                            return xScale(d[1])
                        }
                    })
                    .attr('cy', function (d) {
                        if (d[0] == i) {
                            return xScale(d[2])
                        }
                    })
                    .attr('r', 5)
                    .attr('fill', "blue")
                    .attr('fill-opacity', function (d) {
                        if (d[0] != i) {
                            return "0%"
                        } else {
                            return "100%"
                        }
                    })
                    .attr('class', 'kills');
                ///////
                var div = document.createElement("mapRed" + i);
                document.getElementById("container").appendChild(div);
                div.style.width = "512px";
                div.style.height = "100%";
                div.style.color = "white";

                //div.innerHTML = "Minute " + i + ", RedSide";
                div.id = "mapRed" + i

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

                svg = d3.select("#mapRed" + i).append("svg:svg")
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
                    .attr('cx', function (d) {
                        if (d[0] == i) {
                            return xScale(d[1])
                        }
                    })
                    .attr('cy', function (d) {
                        if (d[0] == i) {
                            return yScale(d[2])
                        }
                    })
                    .attr('r', 5)
                    .attr('fill', "red")
                    .attr('fill-opacity', function (d) {
                        if (d[0] != i) {
                            return "0%"
                        } else {
                            return "100%"
                        }
                    })
                    .attr('class', 'kills');
            }

            document.getElementById("cargando").style.display = "none";
            document.getElementById("range").style.display = "block";
            document.getElementById("inputId").max = minutosPartida - 1;
            document.getElementById("value right").innerHTML = minutosPartida;

            for (var i = 0; i < minutosPartida; i++) {
                document.getElementById("mapBlue" + i).style.display = "none";
                document.getElementById("mapRed" + i).style.display = "none";
            }
            document.getElementById("mapBlue0").style.display = "flex";
            document.getElementById("mapRed0").style.display = "flex";

            const inputSlider = document.getElementById("inputId");
            inputSlider.oninput = (() => {
                let value = inputSlider.value;
                let maxValue = document.getElementById("inputId").max
                
                for(var i = 0; i < maxValue; i++){
                    document.getElementById("mapBlue"+i).style.display = "none";
                    document.getElementById("mapRed"+i).style.display = "none";
                }
                console.log(value)
                console.log(i)
                document.getElementById("mapBlue"+value).style.display = "flex";
                document.getElementById("mapRed"+value).style.display = "flex";
                
            });
        } catch (error) {
            document.getElementById("serverTime").innerHTML = "Error. Contact support.";
            console.log(error)
        }
    }

    getPlayerId(playerName, region, apiKey)
}