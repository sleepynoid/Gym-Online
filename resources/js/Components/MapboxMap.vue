<template>
    <div ref="mapContainer" class="map-container"></div>
</template>

<script>
import { onMounted, ref } from 'vue';
import mapboxgl from 'mapbox-gl';

export default {
    name: 'MapboxMap',
    emits: ['marker-added'], // Declare the emitted event
    props: {
        accessToken: {
            type: String,
            required: true,
        },
        center: {
            type: Array,
            default: () => [0, 0], // Default coordinates (Longitude, Latitude)
        },
        zoom: {
            type: Number,
            default: 2, // Default zoom level
        },
    },
    setup(props, { emit }) {
        const mapContainer = ref(null);
        let mapInstance = null;
        let currentMarker = null; // Variable to store the single marker

        onMounted(() => {
            mapboxgl.accessToken = props.accessToken;

            // Initialize the map
            mapInstance = new mapboxgl.Map({
                container: mapContainer.value,
                style: 'mapbox://styles/mapbox/streets-v11', // Mapbox style
                center: props.center,
                zoom: props.zoom,
            });

            // Add navigation controls
            mapInstance.addControl(new mapboxgl.NavigationControl());

            // Add a marker at the initial center
            currentMarker = new mapboxgl.Marker()
                .setLngLat(props.center)
                .addTo(mapInstance);

            // Emit the initial marker coordinates
            emit('marker-added', {
                lng: props.center[0],
                lat: props.center[1],
            });

            // Add a click event listener to allow moving the marker
            mapInstance.on('click', (event) => {
                const { lng, lat } = event.lngLat; // Get clicked coordinates

                // Remove the existing marker if it exists
                if (currentMarker) {
                    currentMarker.remove();
                }

                // Create a new marker at the clicked location
                currentMarker = new mapboxgl.Marker()
                    .setLngLat([lng, lat])
                    .addTo(mapInstance);

                // Emit the new marker coordinates to the parent component
                emit('marker-added', { lng, lat });

                console.log(
                    `Pinned location: Longitude ${lng}, Latitude ${lat}`,
                );
            });
        });

        return { mapContainer };
    },
};
</script>

<style>
.map-container {
    width: 100%;
    height: 400px;
    /* Ensures proper dimensions for the map container */
}
</style>
