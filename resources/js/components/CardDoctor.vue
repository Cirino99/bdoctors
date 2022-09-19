<template>
    <!-- <div class="card m-3" style="width: 20rem;">
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
            <router-link :to="{name: 'profile', params: {id: doctor.id} }" class="btn btn-primary col-12">Visualizza</router-link>
        </div>
    </div> -->

    <div class="my-card">
        <div class="my-image-content">
            <span class="my-overlay"></span>
            <div class="my-card-image">
                <img class="my-card-img" :src="doctor.photo" :alt="doctor.name">
            </div>
        </div>
        <div class="my-card-content">
            <div>
                <big><strong>Dr.</strong></big>
                <big class="card-title"><b> {{ doctor.name }} </b></big>
                <big class="card-title"><b> {{ doctor.lastname }} </b></big>
            </div>
            <div>
                <big><strong>Città:</strong></big>
                <big>{{ doctor.city}}</big>
            </div>
            <ul class="list-group list-group-flush">
                <li v-for="specialization in doctor.specializations" :key="specialization.id" class="list-group-item">
                    {{ specialization.name }}
                </li>
                <!-- <li class="list-group-item">Voto: {{ doctor.vote}} <font-awesome-icon icon="fas fa-star" /></li> -->
            </ul>

            <span><strong>Voto:</strong> {{doctor.vote}}</span>

            <div class="card-body d-flex flex-column justify-content-end">
                <router-link :to="{name: 'profile', params: {id: doctor.id} }" class="btn btn-primary col-12">Visualizza
                </router-link>
            </div>
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
@import "../../sass/bdoctor-palette.scss";

.my-card {
    width: 250px;
    border-radius: 25px;
    background-color: #FFF;
    color: $dark;
    margin-bottom: 5px;
}

.my-image-content{
    display: flex;
    flex-direction: column;
    align-items: center;
}
.my-card-content {
    text-align: center;
    // display: flex;
    // flex-direction: column;
    // align-items: center;
}

.my-image-content {
    position: relative;
    row-gap: 5px;
    padding: 25px 0;
}

.my-overlay {
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 100%;
    background-color: #4070F4;
    border-radius: 25px 25px 0 25px;
}

.my-overlay::before,
.my-overlay::after {
    content: '';
    position: absolute;
    right: 0;
    bottom: -40px;
    height: 40px;
    width: 40px;
    background-color: #4070F4;
}

.my-overlay::after {
    border-radius: 0 25px 0 0;
    background-color: #FFF;
}

.my-card-image {
    position: relative;
    height: 130px;
    width: 130px;
    border-radius: 50%;
    background: #FFF;
    padding: 3px;
}

.my-card-image .my-card-img {
    height: 100%;
    width: 100%;
    object-fit: cover;
    border-radius: 50%;
}

.my-description {
    font-size: 14px;
    color: #707070;
    text-align: center;
    z-index: 500;
}
</style>
