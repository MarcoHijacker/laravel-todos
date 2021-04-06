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
            <input
                type="text"
                name="pin"
                maxlength="1"
                size="1"
                v-model="task.priority"
                :disabled="isDisabled"
            />
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
            //isStatusChecked: false
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
        editTask(isIconActive, id) {
            if(isIconActive) {
                axios
                    .post("http://127.0.0.1:8000/api/tasks/" + id, this.task)
                    .then(({ data }) => console.log(data))
                    .finally(() => {
                        this.$emit("upd-tasks");
                        this.unlockEditActions();
                        console.log("Task " + id + " updated in DB!");
                    });
            }
        },
        unlockEditActions() {
            this.isDisabled = !this.isDisabled;
            this.isIconActive = !this.isIconActive;
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
