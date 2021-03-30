<template>
    <div class="container">
        <a class="task-creation" href=""
            ><i class="fa fa-plus-square" aria-hidden="true"></i> Create new
            Task</a
        >
        <div class="new-task-module">
            <div class="box">
                <label for="name">Name</label><br />
                <input type="text" v-model="addingTask.name" /><br />
            </div>
            <div class="box">
                <label for="description">Description</label><br />
                <input
                    class="desc-input"
                    type="text"
                    v-model="addingTask.description"
                /><br />
            </div>
            <div class="box">
                <label for="status">Status: </label>
                <select name="status" v-model="addingTask.status">
                    <option value="0" selected>Undone</option>
                    <option value="1">Done</option>
                </select>
                <label for="priority">Priority: </label>
                <select name="priority" v-model="addingTask.priority">
                    <option value="2">High</option>
                    <option value="1">Middle</option>
                    <option value="0">Low</option>
                </select>
            </div>
            <div class="box hidden">
                <label for="name">Checklist ID</label><br />
                <input type="text" :value="checklist" disabled /><br />
            </div>
        </div>
        <div class="box" style="text-align: center; margin: 5px 0;">
            <button @click="storeTask()">
                Push in DB
            </button>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="bd-example">
                    <table class="table">
                        <thead class="table-dark">
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
                checklist_id: this.checklist
            }
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
                        .finally(() =>
                            console.log("Tasks Data loading completed.")
                        );
                });
        },
        updTasks() {
            axios
                .get("http://127.0.0.1:8000/api/tasks/" + this.checklist)
                .then(({ data }) => (this.tasks = data))
                .finally(() => console.log("Tasks Data loading completed."));
        }
    }
};
</script>
