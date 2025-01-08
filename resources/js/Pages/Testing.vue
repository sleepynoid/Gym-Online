<script setup>
import HomeLayout from '@/Layouts/HomeLayout.vue';
</script>
<template>
    <HomeLayout>
        <div class="relative">
            <section class="hero">
                <div class="container">
                    <h1>PREMIUM GYM</h1>
                    <h2>MINIMUM PRICE</h2>
                    <p>Membership starting from Rp249,000/month</p>
                    <a href="register.php" class="btn btn-primary">Register</a>
                </div>
            </section>

            <section class="features">
                <div class="container">
                    <h3>Our Features</h3>
                    <div class="row">
                        <div class="col-md-4">
                            <h4>Personal Trainers</h4>
                            <p>Get guidance from certified trainers.</p>
                        </div>
                        <div class="col-md-4">
                            <h4>Fitness Classes</h4>
                            <p>Join our diverse range of classes.</p>
                        </div>
                        <div class="col-md-4">
                            <h4>Nutrition Plans</h4>
                            <p>Customized meal plans for your goals.</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </HomeLayout>
</template>
