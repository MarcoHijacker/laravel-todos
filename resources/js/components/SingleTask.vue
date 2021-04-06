<template>
    <tr>
        <th scope="row">{{ task.id }}</th>
        <td>
            <input type="text" 
                   v-model="task.name"
                   :disabled="isDisabled"
            />
        </td>
        <td>
            <input
                type="text"
                v-model="task.description"
                :disabled="isDisabled"
            />
        </td>
        <td>
            <select name="priority" :disabled="isDisabled" v-model="task.priority"> 
                <option value="2">High</option>
                <option value="1">Middle</option>
                <option value="0">Low</option>
            </select>
        </td>
        <td>
            <input
                type="checkbox"
                name="pin"
                :checked="task.status === 1"
                @change="changeStatus"
                :disabled="isDisabled"
            />
        </td>
        <td class="action-icons">
            <i
                @click="unlockEditActions"
                class="fa fa-pencil"
                aria-hidden="true"
            ></i>
            <i
                @click="deleteTask(task.id)"
                class="fa fa-trash"
                aria-hidden="true"
                v-show="isDisabled"
            ></i>
            <i
                @click="editTask(task.id)"
                v-show="isIconVisible"
                class="fa fa-check"
                aria-hidden="true"
            ></i>
        </td>
    </tr>
</template>

<script>
export default {
    data() {
        return {
            message: "Prova",
            title: "Head",
            trash: {},
            isDisabled: true,
            isIconVisible: false,
        };
    },
    props: {
        task: Object
    },
    methods: {
        deleteTask(id) {
            axios
                .delete("http://127.0.0.1:8000/api/tasks/" + id)
                .then(response => {
                    this.trash = response.data;
                    console.log(this.trash);
                })
                .finally(() => {
                    this.$emit("upd-tasks");
                });
        },
        editTask(id) {

            axios
                .post("http://127.0.0.1:8000/api/tasks/" + id, this.task)
                .then(({ data }) => console.log(data))
                .finally(() => {
                    this.$emit("upd-tasks");
                    this.unlockEditActions();
                    console.log("Task " + id + " updated in DB!");
                });
        },
        unlockEditActions() {
            this.isDisabled = !this.isDisabled;
            this.isIconVisible = !this.isIconVisible;
        },
        changeStatus() {
            if (this.task.status === 0) {
                return this.task.status = 1;
            } else {
                return this.task.status = 0;
            }
        }
    }
};
</script>
