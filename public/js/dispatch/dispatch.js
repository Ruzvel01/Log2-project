  let maps = {}; // Store map instances

    function initDispatchMap(id) {
        // Delay konti para masiguro na bukas na ang modal bago i-render ang map
        setTimeout(() => {
            if (maps[id]) {
                maps[id].invalidateSize();
                return;
            }

            // 1. Initialize Map (Default view: Philippines)
            const map = L.map(`map${id}`).setView([14.5995, 120.9842], 13);
            maps[id] = map;

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            let startMarker, endMarker;

            // 2. Add Search Control (Geocoder)
            const geocoder = L.Control.geocoder({
                defaultMarkGeocode: false,
                placeholder: "Search location...",
                collapsed: false
            })
            .on('markgeocode', function(e) {
                const latlng = e.geocode.center;
                const name = e.geocode.name;

                // Logic: First search is Start, Second search is End
                if (!startMarker) {
                    startMarker = L.marker(latlng, {draggable: false}).addTo(map)
                        .bindPopup("Start: " + name).openPopup();
                    document.getElementById(`start${id}`).value = name;
                } else {
                    if(endMarker) map.removeLayer(endMarker); // Replace end if already exists
                    endMarker = L.marker(latlng, {draggable: false}).addTo(map)
                        .bindPopup("End: " + name).openPopup();
                    document.getElementById(`end${id}`).value = name;
                    
                    // Zoom out para makita pareho
                    const group = new L.featureGroup([startMarker, endMarker]);
                    map.fitBounds(group.getBounds().pad(0.5));
                }
                map.setView(latlng, 15);
            })
            .addTo(map);

            // 3. Clear button if needed (Optional)
            map.on('contextmenu', function() {
                if(startMarker) map.removeLayer(startMarker);
                if(endMarker) map.removeLayer(endMarker);
                startMarker = null;
                endMarker = null;
                document.getElementById(`start${id}`).value = "";
                document.getElementById(`end${id}`).value = "";
            });

        }, 400);
    }