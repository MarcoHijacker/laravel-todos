<template>
    <div class="container">
        <a @click="toggleForm()" class="task-creation" href="#"><i class="fa fa-plus-square" aria-hidden="true"></i> Create new Task</a>
        <div v-show="formVisible" class="new-task-module">
        <hr>
            <div class="box form-group">
                <label for="name">Name</label><br />
                <input type="text" name="name" v-model="addingTask.name" /><br />
            </div>
            <div class="box form-group">
                <label for="description">Description</label><br />
                <textarea 
                    rows="2"
                    cols="40"
                    name="description"
                    v-model="addingTask.description"
                    >
                </textarea>
                <br />
            </div>
            <div class="box form-group">
                <label for="status">Status: </label>
                <select name="status" v-model="addingTask.status">
                    <option value="0">Undone</option>
                    <option value="1">Done</option>
                </select>
                <label for="priority">Priority: </label>
                <select name="priority" v-model="addingTask.priority">
                    <option value="2">High</option>
                    <option value="1">Middle</option>
                    <option value="0">Low</option>
                </select>
            </div>
            <div class="box form-group hidden">
                <label for="name">Checklist ID</label><br />
                <input type="text" :value="checklist" disabled /><br />
            </div>
            <div class="box" style="text-align: center; margin: 20px 0;">
                <button class="btn btn-success" @click="storeTask()">
                    Push in DB
                </button>
                <button class="btn btn-light" @click="resetForm()">
                    Reset form
                </button>
                <hr>
            </div>
        </div>
        <div class="row justify-content-center tasks-table">
            <div class="col-md-12">
                <div class="bd-example">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Priority</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <single-task
                                v-for="(task, index) in tasks"
                                :key="`tsk${index}`"
                                :task="task"
                                @upd-tasks="updTasks"
                            />
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import SingleTask from "./SingleTask.vue";
export default {
    components: { SingleTask },
    data() {
        return {
            message: "Prova",
            title: "Head",
            tasks: {},
            addingTask: {
                status: 0,
                priority: 1,
                checklist_id: this.checklist
            },
            formVisible: false
        };
    },
    props: {
        checklist: Number
    },
    mounted() {
        axios
            .get("http://127.0.0.1:8000/api/tasks/" + this.checklist)
            .then(({ data }) => (this.tasks = data))
            .finally(() => console.log("Tasks Data loading completed."));
    },
    methods: {
        storeTask() {
            axios
                .post("http://127.0.0.1:8000/api/tasks/", this.addingTask)
                .then(({ data }) => console.log(data))
                .finally(() => {
                    console.log("Task added in DB.");
                    axios
                        .get(
                            "http://127.0.0.1:8000/api/tasks/" + this.checklist
                        )
                        .then(({ data }) => (this.tasks = data))
                        .finally(() => {
                            console.log("Tasks Data loading completed.");
                            this.resetForm();
                        });
                });
        },
        updTasks() {
            axios
                .get("http://127.0.0.1:8000/api/tasks/" + this.checklist)
                .then(({ data }) => (this.tasks = data))
                .finally(() => console.log("Tasks Data loading completed."));
        },
        resetForm() {
            this.addingTask = {
                name: '',
                status: '',
                priority: ''
            }
        },
        toggleForm() {
            this.formVisible = !this.formVisible;
        }
    }
};
</script>
