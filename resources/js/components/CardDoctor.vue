<template>
    <div class="my-card">
        <div class="my-image-content">
            <span class="my-overlay"></span>
            <div class="my-card-image">
                <img class="my-card-img" :src="doctor.photo" :alt="doctor.name">
            </div>
        </div>
        <div class="my-card-content">
            <div class="my-card-name">
                <big><strong>Dr.</strong></big>
                <big class="card-title"><b> {{ doctor.name }} </b></big>
                <big class="card-title"><b> {{ doctor.lastname }} </b></big>
            </div>
            <div>
                <big><strong>Città:</strong></big>
                <big>{{ doctor.city}}</big>
            </div>
            <div>
                <big class="card-title"><b>Su di me</b></big>
                <p class="my-text-cv">{{ doctor.cv }}</p>
            </div>

            <span>
                <strong>Voto:</strong>
                <font-awesome-icon v-for="(myStar, i) in doctor.vote" :key="i" icon="fa-solid fa-star" />
                <font-awesome-icon v-for="(myEmptyStar, j) in (5 - doctor.vote)" :key="j" icon="fa-regular fa-star" />            
            </span>

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

*::-webkit-scrollbar {
    width: 5px;
}

*::-webkit-scrollbar-track {
    background: white;
}

*::-webkit-scrollbar-thumb {
    background-color: #4070F4;
    border-radius: 20px;
    border: 1px solid #4070F4;
}

.my-card {
    width: 250px;
    border-radius: 25px;
    background-color: #FFF;
    color: $dark;
    margin-bottom: 5px;
}

.my-image-content {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.my-card-content {
    text-align: center;

    .my-card-name {
        width: 87%;
    }

    .my-text-cv {
        height: 130px;
        overflow: scroll;
        margin: 0;
        padding-top: 3px;
    }

    .fa-star{
        color: rgb(239, 203, 0);
    }
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
</style>
