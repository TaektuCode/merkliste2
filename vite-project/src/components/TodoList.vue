<template>
    <!-- Hauptcontainer -->
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="flex flex-col items-center w-full max-w-4xl p-4">
            <!-- Aufgabenliste -->
            <div class="w-full bg-white shadow-md rounded-lg mb-8">
                <!-- Titel der Aufgabenliste -->
                <h2
                    class="text-2xl text-center font-bold mb-4 border-b-2 border-gray-300 py-2"
                >
                    Merkliste
                </h2>

                <div class="overflow-x-auto">
                    <!-- Tabelle für die Anzeige der Aufgaben -->
                    <table class="table-auto w-full border-collapse">
                        <!-- Tableheader -->
                        <thead>
                            <tr class="border-t-4 border-b-4 bg-slate-100">
                                <th
                                    class="px-4 py-2 border-r-4 border-gray-300"
                                >
                                    Name
                                </th>
                                <th
                                    class="px-4 py-2 border-r-4 border-gray-300"
                                >
                                    Beschreibung
                                </th>
                                <th
                                    class="px-4 py-2 border-r-4 border-gray-300"
                                >
                                    Datum
                                </th>
                                <th
                                    class="px-4 py-2 border-r-4 border-gray-300"
                                >
                                    Uhrzeit
                                </th>
                                <th
                                    class="px-4 py-2 border-r-4 border-gray-300"
                                >
                                    Erledigt
                                </th>
                                <th class="px-4 py-2">Aktion</th>
                            </tr>
                        </thead>
                        <!-- Tabelleninhalt -->
                        <tbody>
                            <!-- for-loop über alle Todos -->
                            <tr v-for="todo in result" :key="todo.id">
                                <!-- Zellen für die einzelnen Eigenschaften eines Todos -->
                                <td class="text-center">{{ todo.name }}</td>
                                <td class="px-2">{{ todo.beschreibung }}</td>

                                <td class="text-center">{{ todo.datum }}</td>
                                <td class="text-center">
                                    {{ formatTime(todo.uhrzeit) }} Uhr
                                </td>
                                <td class="text-center">
                                    <!-- Checkbox zur Anzeige und Bearbeitung des Erledigt-Status -->
                                    <input
                                        type="checkbox"
                                        v-model="todo.erledigt"
                                        @change="updateStatus(todo)"
                                    />
                                </td>

                                <td class="text-center">
                                    <!-- Aufgabe editieren Button -->
                                    <button
                                        type="button"
                                        class="bg-yellow-400 px-4 py-2 rounded-full mr-2"
                                        @click="edit(todo)"
                                    >
                                        Edit
                                    </button>
                                    <!-- Aufgabe löschen Button -->
                                    <button
                                        type="button"
                                        class="bg-red-500 px-4 py-2 rounded-full"
                                        @click="remove(todo)"
                                    >
                                        Löschen
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Formular zur Erstellung einer neuen Aufgabe -->
            <div class="w-full bg-white shadow-md rounded-lg">
                <!-- Titel des Formulars -->
                <h2
                    class="text-2xl text-center font-bold mb-4 border-b-2 border-gray-300 py-2"
                >
                    Neue Aufgabe
                </h2>
                <!-- Formular für die Eingabe neuer Aufgaben -->
                <form
                    @submit.prevent="save"
                    class="bg-white shadow-md rounded px-8 pt-6 pb-8"
                >
                    <!-- Eingabefelder -->
                    <!-- Name -->
                    <div class="mb-4">
                        <label
                            for="name"
                            class="block text-gray-700 text-sm font-bold mb-2"
                            >Name</label
                        >
                        <input
                            type="text"
                            name="name"
                            id="name"
                            v-model="todo.name"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        />
                    </div>
                    <!-- Beschreibung -->
                    <div class="mb-4">
                        <label
                            for="beschreibung"
                            class="block text-gray-700 text-sm font-bold mb-2"
                            >Beschreibung</label
                        >
                        <input
                            type="text"
                            name="beschreibung"
                            id="beschreibung"
                            v-model="todo.beschreibung"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        />
                    </div>
                    <!-- Datum -->
                    <div class="mb-4">
                        <label
                            for="datum"
                            class="block text-gray-700 text-sm font-bold mb-2"
                            >Datum</label
                        >
                        <input
                            type="date"
                            name="datum"
                            id="datum"
                            v-model="todo.datum"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        />
                    </div>
                    <!-- Uhrzeit -->
                    <div class="mb-4">
                        <label
                            for="uhrzeit"
                            class="block text-gray-700 text-sm font-bold mb-2"
                            >Uhrzeit</label
                        >
                        <input
                            type="time"
                            id="uhrzeit"
                            name="uhrzeit"
                            v-model="todo.uhrzeit"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        />
                    </div>
                    <!-- Button zum Absenden des Formulars -->
                    <div class="mb-4 flex justify-between">
                        <!-- Buttons für "Anlegen" und "Zurücksetzen" -->
                        <div>
                            <button
                                type="submit"
                                class="bg-green-500 mr-2 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            >
                                Anlegen
                            </button>
                            <button
                                type="reset"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                @click="clearTodoFields"
                            >
                                Zurücksetzen
                            </button>
                        </div>

                        <!-- Button für "Löschen" -->
                        <button
                            type="button"
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded focus:outline-none focus:shadow-outline text-sm"
                            @click="deleteAllTodos"
                        >
                            Alle Aufgaben Löschen
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "TodoList",
    data() {
        return {
            result: {},
            todo: {
                id: "",
                name: "",
                beschreibung: "",
                datum: "",
                uhrzeit: "",
                aktion: "",
            },
            selectedFilter: "all",
        };
    },
    created() {
        this.TodoLoad();
    },
    mounted() {
        console.log("mounted() called.......");
    },

    methods: {
        // Todos aus dem Backend laden
        async TodoLoad() {
            try {
                const response = await axios.get(
                    "http://127.0.0.1:8000/api/todo"
                );
                // Die Aufgaben mappen und die Eigenschaft 'erledigt' entsprechend ihres Werts setzen
                this.result = response.data.map((todo) => ({
                    ...todo,
                    erledigt: todo.erledigt === "erledigt",
                }));
            } catch (error) {
                console.error("Error loading todos:", error);
                alert("Fehler beim Laden der Aufgaben. Versuche es nochmal.");
            }
        },
        // Aufgabe speichern oder bereits angelegte editieren
        async save() {
            if (this.todo.id === "") {
                await this.saveData();
            } else {
                await this.updateData();
            }
        },
        // Aufgabe speichern
        async saveData() {
            try {
                const response = await axios.post(
                    "http://127.0.0.1:8000/api/todo",
                    this.todo
                );
                console.log("Todo created:", response.data);
                alert("Aufgabe angelegt!");
                this.clearTodoFields();
                await this.TodoLoad();
            } catch (error) {
                console.error("Error creating todo:", error);
                alert(
                    "Fehler beim Erstellen der Aufgabe. Versuche es nochmal."
                );
            }
        },
        // Status der Aufgabe updaten (erledigt / nicht erledigt)
        async updateStatus(todo) {
            const status = todo.erledigt ? "erledigt" : "nicht erledigt";
            try {
                await axios.put(`http://127.0.0.1:8000/api/todo/${todo.id}`, {
                    erledigt: status,
                });
                console.log(`Status updated for todo ${todo.id}`);
            } catch (error) {
                console.error("Error updating status:", error);
            }
        },
        // Editieren einer Aufgabe
        edit(todo) {
            this.todo = { ...todo }; // Ensure immutability by creating a new object
        },
        // Update einer Aufgabe
        async updateData() {
            try {
                const response = await axios.put(
                    `http://127.0.0.1:8000/api/todo/${this.todo.id}`,
                    this.todo
                );
                console.log("Todo updated:", response.data);
                alert("Erfolgreich geändert!");
                this.clearTodoFields();
                await this.TodoLoad();
            } catch (error) {
                console.error("Error updating todo:", error);
                alert(
                    "Fehler beim Aktualisieren der Aufgabe. Versuche es nochmal."
                );
            }
        },
        // Todo löschen
        async remove(todo) {
            try {
                await axios.delete(`http://127.0.0.1:8000/api/todo/${todo.id}`);
                alert("Aufgabe gelöscht!");
                await this.TodoLoad();
            } catch (error) {
                console.error("Error deleting todo:", error);
                alert("Fehler beim Löschen der Aufgabe. Versuche es nochmal.");
            }
        },
        // ALLE Todos löschen
        async deleteAllTodos() {
            try {
                // Führen Sie einen Axios-Aufruf zum Löschen aller Todos aus
                await axios.delete("http://127.0.0.1:8000/api/todos");

                // Bei erfolgreichem Löschen die Todo-Liste aktualisieren
                await this.TodoLoad();

                alert("Alle Todos erfolgreich gelöscht!");
            } catch (error) {
                console.error("Fehler beim Löschen der Todos:", error);
                alert("Fehler beim Löschen der Todos. Versuche es nochmal.");
            }
        },
        // Methode zur Formatierung der Zeit, um nur Stunden und Minuten anzuzeigen
        formatTime(time) {
            if (!time) return ""; // Wenn die Zeit leer oder null ist, leere Zeichenfolge zurückgeben

            // Die Zeitzeichenfolge in Stunden, Minuten und Sekunden aufteilen
            const [hours, minutes, seconds] = time.split(":");

            // Formatierter Zeitstring mit nur Stunden und Minuten zurückgeben
            return `${hours}:${minutes}`;
        },
        // "Neue Aufgabe" Felder zurücksetzen
        clearTodoFields() {
            this.todo.name = "";
            this.todo.beschreibung = "";
            this.todo.datum = "";
            this.todo.uhrzeit = "";
            this.todo.id = "";
        },
    },
};
</script>
