<script setup>
import { ref, onMounted } from 'vue';

const cryptoStats = ref([]);
const loading = ref(true);
const error = ref(null);

const fetchCryptoStats = async () => {
    const apiUrl =
        'https://api.coingecko.com/api/v3/simple/price?ids=bitcoin,ethereum&vs_currencies=usd';

    try {
        const response = await fetch(apiUrl);
        if (!response.ok) {
            throw new Error('Failed to fetch cryptocurrency data');
        }
        cryptoStats.value = await response.json();
    } catch (err) {
        error.value = err.message;
    } finally {
        loading.value = false;
    }
};

onMounted(() => {
    fetchCryptoStats();
});
</script>

<template>
    <section>
        <div class="p-6 text-gray-900">
            <h3 class="text-lg font-bold">Cryptocurrency Stats</h3>
            <div v-if="loading" class="text-gray-500">
                Loading cryptocurrency data...
            </div>
            <div v-else-if="error" class="text-red-500">
                {{ error }}
            </div>
            <div v-else>
                <p>
                    <strong>Bitcoin (BTC):</strong> ${{
                        cryptoStats.bitcoin.usd
                    }}
                </p>
                <p>
                    <strong>Ethereum (ETH):</strong> ${{
                        cryptoStats.ethereum.usd
                    }}
                </p>
            </div>
        </div>
    </section>
</template>
