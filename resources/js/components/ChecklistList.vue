<template>
    <section>
        <div class="text-center" style="margin-bottom: 20px;">
            <a v-if="!formVisible" @click="toggleForm()" class="task-creation" href="#"><i class="fa fa-plus-square" aria-hidden="true"></i> Create new Checklist</a>
            <a v-else @click="toggleForm()" class="task-creation" href="#"><i class="fa fa-minus-square" aria-hidden="true"></i> Create new Checklist</a>
        </div>

        <transition name="list">
            <div v-show="formVisible" class="new-task-module">
            <hr>
                <div class="box form-group">
                    <label for="name">Name</label><br />
                    <input type="text" name="name" v-model="addingChecklist.name" /><br />
                </div>
                <div class="box form-group">
                    <label for="description">Description</label><br />
                    <textarea 
                        rows="2"
                        cols="40"
                        name="description"
                        v-model="addingChecklist.description"
                        >
                    </textarea>
                    <br />
                </div>
                <div class="box form-group">
                    <label for="priority">Priority: </label>
                    <select name="priority" v-model="addingChecklist.priority">
                        <option value="2">High</option>
                        <option value="1">Middle</option>
                        <option value="0">Low</option>
                    </select>
                </div>
                <div class="box form-group hidden">
                    <label for="name">User ID</label><br />
                    <input type="text" :value="loggeduser" disabled /><br />
                </div>
                <div class="box" style="text-align: center; margin: 20px 0;">
                    <button class="btn btn-success" @click="storeChecklist()">
                        Push in DB
                    </button>
                    <button class="btn btn-light" @click="resetForm()">
                        Reset form
                    </button>
                    <hr>
                </div>
            </div>
        </transition>

        <single-checklist
          v-for="checklist in checklists"
          :key="`chk${checklist.id}`"
          :checklist="checklist"
          @upd-checklists="updChecklists"
        />
    </section>
</template>

<script>
import axios from "axios";
import SingleChecklist from "./SingleChecklist.vue";
export default {
    components: { SingleChecklist },
    data() {
        return {
            refresh: false,
            checklists: {},
            relatedLists: {
                user_id: this.loggeduser
            },
            addingChecklist: {
                status: 0,
                priority: 1,
                user_id: this.loggeduser
            },
            formVisible: false,

        };
    },
    props: {
        loggeduser: Number,
    },
    mounted() {
        axios
            .post("http://127.0.0.1:8000/api/checklists/user/", this.relatedLists)
            .then(response => {
                this.checklists = response.data;
            })
            .finally(() => {
                console.log('Checklist data loading completed.');
            });
    },
    methods: {
        toggleForm() {
            this.formVisible = !this.formVisible;
        },
        storeChecklist() {
            axios
                .post("http://127.0.0.1:8000/api/checklists/", this.addingChecklist)
                .then(({ data }) => console.log(data))
                .finally(() => {
                    console.log("Checklist added in DB.");
                    this.updChecklists();
                });
        },
        resetForm() {
            this.addingChecklist = {
                name: '',
                description: '',
                status: 0,
                priority: 1,
                user_id: this.loggeduser
            }
        },
        updChecklists() {
            axios
                .post("http://127.0.0.1:8000/api/checklists/user/", this.relatedLists)
                .then(response => {
                    this.checklists = response.data;
                })
                .finally(() => {
                    console.log('Checklist data loading completed.');
                });
        },
    }
};
</script>

<style scoped>
    .list-enter-active, .list-leave-active {
        transition: all 0.5s;
    }
    .list-enter, .list-leave-to {
        opacity: 0;
        transform: translateY(20px);
    }
</style>
