// $(document).ready(function () {
//     $("#div1").hide();
// });

// $(document).ready(function () {
//     $("#button1").click(function () {
//         $("#div1").show();
//     });
// });
// require([
//     "esri/config",
//     "esri/Map",
//     "esri/views/MapView",
//     "esri/widgets/Search",
//     "esri/widgets/Expand",
//     "esri/rest/locator",
//     "esri/Graphic",
//     "esri/layers/GraphicsLayer",
// ], (
//     esriConfig,
//     Map,
//     MapView,
//     Search,
//     Expand,
//     locator,
//     Graphic,
//     GraphicsLayer
// ) => {
//     esriConfig.apiKey =
//         "AAPKb1c5f091254949a1a6bb72817136dd19aY7CE5U8W3eKrfJuDkpJ1lS3Pdi6rPGasHL42WuhSfp8LQwduhqPWidCmyMcr7Pj";
//     const placesLayer = new GraphicsLayer();
//     const map = new Map({
//         basemap: "arcgis-navigation", //Basemap layer service
//         layers: [placesLayer],
//     });

//     const view = new MapView({
//         container: "viewDiv",
//         map: map,
//         center: [76.936638, 8.524139],
//         zoom: 14,
//         constraints: {
//             snapToZoom: false,
//         },
//     });

//     view.popup.actions = [];
//     view.popup.alignment = "bottom-left";

//     const places = [
//         ["Coffee shop", "coffee-shop"],
//         ["Gas station", "gas-station"],
//         ["Food", "restaurant"],
//         ["Hotel", "hotel"],
//         ["Parks and Outdoors", "park"],
//     ];
//     const select = document.createElement("select", "");
//     select.setAttribute("class", "esri-widget esri-select");
//     select.setAttribute(
//         "style",
//         "width: 175px; font-family: 'Avenir Next'; font-size: 1em"
//     );
//     places.forEach((p) => {
//         const option = document.createElement("option");
//         option.value = p[0];
//         option.innerHTML = p[0];
//         select.appendChild(option);
//     });

//     view.ui.add(select, "top-left");

//     const geocodingServiceUrl =
//         "http://geocode-api.arcgis.com/arcgis/rest/services/World/GeocodeServer";

//     function findPlaces(category, pt) {
//         locator
//             .addressToLocations(geocodingServiceUrl, {
//                 location: pt,
//                 categories: [category],
//                 maxLocations: 25,
//                 outFields: ["PlaceName", "Place_addr"],
//             })
//             .then((results) => {
//                 view.popup.close();
//                 placesLayer.graphics.removeAll();
//                 results.forEach((result) => {
//                     placesLayer.graphics.add(
//                         new Graphic({
//                             attributes: result.attributes,
//                             geometry: result.location,
//                             symbol: {
//                                 type: "web-style",
//                                 name: places[
//                                     places.findIndex(
//                                         (a) => a[0] === select.value
//                                     )
//                                 ][1],
//                                 styleName: "Esri2DPointSymbolsStyle",
//                             },
//                             popupTemplate: {
//                                 title: "{PlaceName}",
//                                 content:
//                                     "{Place_addr}" +
//                                     "<br><br>" +
//                                     result.location.x.toFixed(5) +
//                                     "," +
//                                     result.location.y.toFixed(5),
//                             },
//                         })
//                     );
//                 });
//                 if (results.length) {
//                     // const g = placesLayer.graphics.getItemAt(0);
//                     view.popup.open({
//                         features: placesLayer.graphics.toArray(),
//                         updateLocationEnabled: true,
//                     });
//                 }
//             });
//     }

//     // Search for places in center of map
//     view.when(() => {
//         findPlaces(select.value, view.center);
//     });

//     // Listen for category changes and find places
//     select.addEventListener("change", (event) => {
//         findPlaces(event.target.value, view.center);
//     });

//     // Listen for mouse clicks and find places
//     view.on("click", (event) => {
//         view.hitTest(event.screenPoint).then((response) => {
//             if (response.results.length < 2) {
//                 // If graphic is not clicked, find places
//                 findPlaces(
//                     select.options[select.selectedIndex].text,
//                     event.mapPoint
//                 );
//             }
//         });
//     });

//     // Search term
//     const term = "Kerala";
//     let automate = true;

//     // Add Search widget
//     const search = new Search({
//         view: view,
//     });
//     view.ui.add(
//         new Expand({
//             view: view,
//             content: search,
//             expanded: true,
//             mode: "floating",
//         }),
//         "top-right"
//     );

//     // Start suggestions
//     view.when(() => {
//         search.watch("activeSource", (source) => {
//             search.searchTerm = term.substring(0, 1);
//             search.suggest(search.searchTerm);
//         });
//     });

//     // Select last suggestion
//     search.on("suggest-complete", (response) => {
//         if (!automate) {
//             return;
//         }
//         if (search.searchTerm.length < term.length) {
//             search.searchTerm = term.substring(0, search.searchTerm.length + 1);
//             setTimeout(() => {
//                 search.suggest(search.searchTerm);
//             }, 250);
//         } else {
//             if (response.results.length > 0) {
//                 search.search(response.results[0].results[0]);
//             }
//         }
//     });

//     search.on("select-result", (response) => {
//         if (!automate) {
//             return;
//         }
//         if (response.result) {
//             search.suggest(term);
//             automate = false;
//         }
//     });

//     search.goToOverride = (view, goToParams) => {
//         if (!automate) {
//             return view.goTo(goToParams.target, goToParams.options);
//         } else {
//             return view.goTo(
//                 {
//                     center: goToParams.target.target,
//                     zoom: 11,
//                 },
//                 goToParams.options
//             );
//         }
//     };

//     search.on(["search-clear", "search-focus"], () => {
//         automate = false;
//     });
// });
