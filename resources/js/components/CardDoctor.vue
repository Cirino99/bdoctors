<template>
    <div class="card m-3" style="width: 20rem;">
        <div class="card-body d-flex justify-content-between flex-wrap">
            <img class="card-img-top img-fluid rounded-circle d-flex order-1 col-8 col-md-6 col-lg-6" :src="doctor.photo" :alt="doctor.name">
            <div class="col-12 col-md-6 col-lg-4 fst-italic">
                <big class="card-title"><b> {{ doctor.name }} </b></big>
                <big class="card-title"><b> {{ doctor.lastname }} </b></big>
                <p class="card-text">Testo</p>
            </div>
        </div>
        <ul class="list-group list-group-flush fst-italic">
            <li v-for="specialization in doctor.specializations" :key="specialization.id" class="list-group-item">
                {{ specialization.name }}
            </li>
            <li class="list-group-item">VALUTAZIONE</li>
        </ul>
        <div class="card-body d-flex flex-column justify-content-end">
            <!-- <a href="#" class="card-link">Visualizza</a> -->
            <router-link :to="{name: 'profile', params: {id: doctor.id} }" class="btn btn-primary col-12">Visualizza</router-link>
        </div>
    </div>
</template>

<script>
export default {
    name: 'CardDoctors',
    props: {
        doctor: Object,
    }
}
</script>

<style lang="scss" scoped>
    img {
        min-width: 100px;
        min-height: 100px;
        width: 8vw;
        height: 8vw;
        object-fit: cover;
        object-position: center;
    }
</style>
