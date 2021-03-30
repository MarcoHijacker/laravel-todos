<template>
  <tr>

    <th scope="row">{{ task.id }}</th>
    <td>
        <input type="text" :value="task.name" :disabled="isDisabled" />
    </td>
    <td>
        <input type="text" :value="task.description" :disabled="isDisabled" />
    </td>
    <td>
        <input type="number" :value="task.priority" :disabled="isDisabled" />
    </td>
    <td>
        <input type="number" :value="task.status" :disabled="isDisabled" />
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
        <i v-if="isIconVisible" class="fa fa-check" aria-hidden="true"></i>
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
            isIconVisible: false
        };
    },
    props: {
        task: Object
    },
    methods: {
        deleteTask(id) {
            axios
                .delete("http://127.0.0.1:8000/api/tasks/" + id)
                .then( res  => {
                  this.trash = res.data;
                  console.log(this.trash);
                })
                .finally(() => {
                    console.log("Task " + id + " deleted.");
                });
        },
        unlockEditActions() {
          this.isDisabled = !this.isDisabled;
          this.isIconVisible = !this.isIconVisible;
          
        }
    }
};
</script>
