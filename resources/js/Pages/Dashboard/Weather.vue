<script setup>
import { ref, onMounted } from 'vue';

const weatherData = ref(null);
const loading = ref(true);
const error = ref(null);

const fetchWeather = async () => {
    const apiKey = '0932859b64891fb039ef4b9f00ecc7f2';
    const city = 'Surabaya';
    const apiUrl = `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}&units=metric`;

    try {
        const response = await fetch(apiUrl);
        if (!response.ok) {
            throw new Error('Failed fetch weather data');
        }
        const data = await response.json();
        weatherData.value = data;
    } catch (err) {
        error.value = err.message;
    } finally {
        loading.value = false;
    }
};

onMounted(() => {
    fetchWeather();
});
</script>

<template>
    <section>
        <div class="p-6 text-gray-900">
            <h3 class="text-lg font-bold">Current Weather</h3>
            <div v-if="loading" class="text-gray-500">
                Loading weather data...
            </div>
            <div v-else-if="error" class="text-red-500">
                {{ error }}
            </div>
            <div v-else>
                <p><strong>City:</strong> {{ weatherData.name }}</p>
                <p>
                    <strong>Temperature:</strong>
                    {{ weatherData.main.temp }}&deg;C
                </p>
                <p>
                    <strong>Weather:</strong>
                    {{ weatherData.weather[0].description }}
                </p>
            </div>
        </div>
    </section>
</template>
