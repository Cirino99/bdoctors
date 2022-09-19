<template>
    <div class="">
        <div class="container">
            <div class="d-flex flex-column justify-content-center">
                <div class="col-2 col-md-12 m-2 p-2" style="min-width: 250px;">
                    <div class="card w-100 m-auto">
                        <div class="card-header">
                            <h4>Filtra per:</h4>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Città:</strong><br>
                                <form class="d-flex form-inline py-2 my-lg-0">
                                    <input v-model="search" @keyup.enter="searchDoctor" class="form-control mr-sm-2 rounded-3 w-50 me-2"
                                        type="search" placeholder="Scrivi qui.." aria-label="Search">
                                    <button class="btn btn-outline-primary my-2 m my-sm-0 rounded-3" type="submit">Filtra</button>
                                </form>
                            </li>
                            <li class="list-group-item d-flex flex-column flex-wrap flex-md-row gap-2"><strong>Specializzazione:</strong><br>
                                <div v-for="specialization in specializations" :key="specialization.id" class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault1" :checked=" specializationSelect === specialization.id"
                                        @click="changeSpecialization(specialization.id)">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        {{ specialization.name }}
                                    </label>
                                </div>
                            </li>
                            <!-- <li class="list-group-item">A third item</li> -->
                        </ul>
                    </div>
                </div>
                <div class="d-flex flex-wrap justify-content-start col-9">
                    <CardDoctor v-for="(doctor, index) in doctors" :key="index" :doctor="doctor" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import CardDoctor from '../components/CardDoctor.vue'
export default {
    name: 'PageAdvanceSearch',
    props: {
        specializationSelect: Number,
    },
    components: {
        CardDoctor,
    },
    data() {
        return {
            doctors: [],
            specializations: [],
            search: ''
        }
    },
    created() {
        axios.get('/api/search/specialization?specialization=')
            .then(res => {
                if (res.data.success) {
                    this.specializations = res.data.result;
                }
            });
        this.searchDoctor();
    },
    methods: {
        searchDoctor(){
            axios.get('api/search?specialization=' + this.specializationSelect + '&city=all&reviews=0&vote=1')
            .then(res => {
                if (res.data.success) {
                    this.doctors = res.data.result;
                }
            })
        },
        changeSpecialization(id){
            this.specializationSelect = id;
            this.searchDoctor();
        }
    }
}
</script>

<style lang="scss" scoped>

    @import "../../sass/bdoctor-palette.scss"; 
    .card {
        width: 60vw;
        color: $primary;
        .form-check {
            display: inline-block;
        }
    }
</style>