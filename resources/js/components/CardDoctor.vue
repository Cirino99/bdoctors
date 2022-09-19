<template>
    <div class="card m-3" style="width: 18rem;">
        <img class="card-img-top" src="" alt="Card image cap">
        <div class="card-body">
        <h5 class="card-title"> {{ doctor.name }} </h5>
        <h5 class="card-title"> {{ doctor.lastname }} </h5>
        <p class="card-text">Testo</p>
        </div>
        <ul class="list-group list-group-flush">
        <li v-for="specialization in doctor.specializations" :key="specialization.id" class="list-group-item">
            {{ specialization.name }} 
        </li>
        <li class="list-group-item">VALUTAZIONE</li>
        </ul>
        <div class="card-body">
        <a href="#" class="card-link">Visualizza</a>
        <router-link :to="{name: 'profile', params: {id: doctor.id} }" class="btn btn-primary">Visualizza</router-link>
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

</style>