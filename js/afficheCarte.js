var commune = document.getElementById('loc').value;

var LatCommune = document.getElementById('LatCommune').value;
var LongCommune = document.getElementById('LongCommune').value;
var dep = document.getElementById('dep').value;

// console.log(commune);
// console.log(dep);
// console.log(LatCommune);
// console.log(LongCommune);
selectMap(dep);
function selectMap(a) {
    if (a === '16') {
        let map16 = new Map(16, 7000, [-0.00138, 45.603744], [120, 145], 300, 250, 16);
        return map16.afficheMap();
    }
    if (a === '17') {
        let map17 = new Map(17, 7000, [-0.00138, 45.603744], [210, 185], 300, 320, 16);
        return map17.afficheMap();
    }
    if (a === '19') {
        let map19 = new Map(19, 8500, [1.873739, 45.372114], [120, 125], 300, 250, 16);
        return map19.afficheMap();
    }
    if (a === '23') {
        let map23 = new Map(23, 8600, [2.062783, 46.037763], [130, 125], 300, 250, 16);
        return map23.afficheMap();
    }
    if (a === '24') {
        let map24 = new Map(24, 8600, [0.7572205, 45.1469486], [130, 125], 300, 250, 16);
        return map24.afficheMap();
    }
    if (a === '33') {
        let map33 = new Map(33, 8600, [-0.612943, 44.827778], [105, 157], 300, 300, 16);
        return map33.afficheMap();
    }
    if (a === '40') {
        let map40 = new Map(40, 8600, [-0.612943, 44.827778], [140, -50], 300, 250, 16);
        return map40.afficheMap();
    }
    if (a === '47') {
        let map47 = new Map(47, 11000, [0.4502368, 44.2470173], [120, 155], 300, 250, 16);
        return map47.afficheMap();
    }
    if (a === '64') {
        let map64 = new Map(64, 10000, [-0.7532809, 43.3269942], [180, 80], 320, 220, 16);
        return map64.afficheMap();
    }
    if (a === '79') {
        let map79 = new Map(79, 8600, [-0.3962844, 46.5926541], [140, 140], 300, 290, 16);
        return map79.afficheMap();
    }
    if (a === '86') {
        let map86 = new Map(86, 8600, [0.505393488, 46.554958152], [160, 160], 300, 290, 16);
        return map86.afficheMap();
    }
    if (a === '87') {
        let map87 = new Map(87, 8600, [1.4025484, 45.7435173], [180, 170], 300, 250, 16);
        return map87.afficheMap();
    }
}

/*----------  Fin Sert à sélectionner la fonction carte correspondante à var "dep" (n° du dep)  ----------*/
/*----------  Constructeur  ----------*/
function Map(d, s, c, t, w, h, z) {
    this.departement = d;
    this.departement2 = z;
    this.scale = s;
    this.center = c;
    this.translate = t;
    this.width = w;
    this.height = h;

    /*----------  Prototype  ----------*/
    this.afficheMap = function () {


        var aProjection = d3.geoMercator()
            .scale(s)
            .center([c[0], c[1]])
            .translate([t[0], t[1]]);

        var geoPath = d3.geoPath().projection(aProjection);

        var toto = d3.select("svg#map").attr("width", w).attr("height", h).selectAll("g")
        //   .data(data.features)
        //   .enter()
        //   .append('g')
        //   .attr('id', d => d.properties.code)
        //   .attr("opacity", "1")
        //   .append("path")
        //   .attr("d", geoPath)
        //   .attr("class", d => d.properties.ColorT1);

        var svg = d3.select("svg#map");
        width = +svg.attr("width"),
            height = +svg.attr("height");

        // var MenuA = document.getElementById('loc').value;
        // var commune = MenuA.slice(0, length - 5);

        // var LatCommune = document.getElementById('LatCommune').value;
        // var LongCommune = document.getElementById('LongCommune').value;
        var markers = [{
            Long: LongCommune,
            Lat: LatCommune
        }];

        // var dep = (MenuA.slice(-4)).replace('(', '').replace(')', '');

        var carte2 = d3.select('svg#map');

        d3.json('js/maps/departement-' + dep + '.geojson').then(function (geojson) {
            svg.append("g")
                .attr('id', 'carte2')
                .selectAll("path")
                .data(geojson.features)
                .enter()
                .append("path")
                .attr("d", geoPath)
                .style('fill', '#ffffffde')
                .style('stroke', 'none')
                .style('stroke-width', '2')
                .style('stroke-opacity', '1')

            d3.json('js/maps/departement-eau-' + dep + '.geojson').then(function (geojson) {
                svg.append("g")
                    .attr('id', 'carte3')
                    .selectAll("path")
                    .data(geojson.features)
                    .enter()
                    .append("path")
                    .attr("d", geoPath)
                    .style('fill', 'none')
                    .style('stroke', '#2196F3')
                    .style('stroke-width', '1')
                    .style('stroke-opacity', '0.5')

                d3.json('js/maps/departement-Lacs-' + dep + '.geojson').then(function (geojson) {
                    svg.append("g")
                        .attr('id', 'carte3')
                        .selectAll("path")
                        .data(geojson.features)
                        .enter()
                        .append("path")
                        .attr("d", geoPath)
                        .style('fill', '#2196F3')
                        .style('fill-opacity', '0.5')
                        .style('stroke', 'none')

                    d3.json('js/maps/departement-' + dep + '.geojson').then(function (geojson) {
                        d3.select("svg#map").selectAll("circle").data(markers)
                            .enter()
                            .append("circle")
                            .attr('id', 'point')
                            .attr('r', 8 + 'px')
                            .attr('class', 'redR')
                            .attr("d", geoPath)
                            .attr("cx", d => aProjection([d.Long, d.Lat])[0])
                            .attr("cy", d => aProjection([d.Long, d.Lat])[1]),
                            /*----------  Sert à récupérer le nom de la commune pour afficher texte ----------*/
                            d3.select("svg#map").selectAll("text").data(markers)
                                .enter()
                                .append("text")
                                .attr('id', 'locx')
                                .text(commune)
                                .attr("x", d => aProjection([d.Long, d.Lat])[0])
                                .attr("y", d => aProjection([d.Long, d.Lat])[1] - 14 + 'px')

                        positionTxt()
                    })
                })
            })
        })
        var CodeCommune = document.getElementById('CodeCommune').value;
    }
}


function positionTxt() {
    let positionX = document.getElementById("locx");
    var a = positionX.getAttribute("x");
    console.log(a);
    if (a > 175) {
        positionX.setAttribute('class', 'locTxt locL');
    }
    if (a < 175) {
        positionX.setAttribute('class', 'locTxt loc');
    }
    if (a < 125) {
        positionX.setAttribute('class', 'locTxt locR');
    }
}