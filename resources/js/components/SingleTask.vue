<template>
    <tr class="content-row">
        <td>
            <input
                type="checkbox"
                name="pin"
                :checked="task.status === 1"
                @change="changeStatus(task.id)"
            />
        </td>
        <td>
            <input type="text" v-model="task.name" :disabled="isDisabled" />
        </td>
        <td>
            <input
                type="text"
                v-model="task.description"
                :disabled="isDisabled"
            />
        </td>
        <td>
            <select
                name="priority"
                :disabled="isDisabled"
                v-model="task.priority"
            >
                <option value="2">High</option>
                <option value="1">Middle</option>
                <option value="0">Low</option>
            </select>
        </td>
        <td class="action-icons">
            <i
                @click="deleteTask(task.id)"
                class="fa fa-trash"
                aria-hidden="true"
            ></i>
        </td>
        <td class="action-icons">
            <i
                @click="unlockEditActions"
                class="fa fa-pencil"
                aria-hidden="true"
            ></i>
            <i
                @click="editTask(isIconActive, task.id)"
                :class="['fa fa-check', isIconActive ? '' : 'deniedAct']"
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
            isIconActive: false,
            newMove: '',
        };
    },
    props: {
        task: Object
    },
    methods: {
        deleteTask(id) {
            if(confirm('This will perform permanent deletion. Are you sure?')) {
                axios
                    .delete("http://127.0.0.1:8000/api/tasks/" + id)
                    .then(response => {
                        this.trash = response.data;
                        console.log(this.trash);
                    })
                    .finally(() => {
                        this.newMove = 'Deleted Task ID ' + id;
                        this.$emit("upd-tasks");
                        this.$emit("new-move", this.newMove);
                    });
            }
        },
        editTask(isIconActive, id) {
            if (isIconActive) {
                axios
                    .post("http://127.0.0.1:8000/api/tasks/" + id, this.task)
                    .then(({ data }) => console.log(data))
                    .finally(() => {
                        this.newMove = 'Edited Task ID ' + id;
                        this.$emit("upd-tasks");
                        this.$emit("new-move", this.newMove);
                        this.unlockEditActions();
                    });
            }
        },
        statusTask(id) {
            axios
                .post("http://127.0.0.1:8000/api/tasks/" + id, this.task)
                .then(({ data }) => console.log(data))
                .finally(() => {
                    this.newMove = 'Edited Task ID ' + id;
                    this.$emit("upd-tasks");
                    this.$emit("new-move", this.newMove);
            });
        },
        unlockEditActions() {
            this.isDisabled = !this.isDisabled;
            this.isIconActive = !this.isIconActive;
        },
        changeStatus(id) {
            if (this.task.status === 0) {
                this.task.status = 1;
            } else {
                this.task.status = 0;
            }
            this.statusTask(id);
        }
    }
};
</script>
