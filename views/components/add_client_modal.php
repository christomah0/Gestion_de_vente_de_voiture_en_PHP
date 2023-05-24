<div class="fixed z-10 inset-0 overflow-y-auto hidden" id="a-modal">
    <div class="flex items-center justify-center min-h-screen">
        <!-- rend l'effet de transparence en arrière-plan -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-black opacity-50"></div>
        </div>
        <!-- fenêtre modal -->
        <div class="bg-white overflow-hidden shadow-xl transform transition-all sm:w-full sm:mx-auto max-w-md text-gray-600 rounded">
            <!-- titre et bouton fermé -->
            <div class="flex justify-between p-3">
                <div class="relative block px-2 py-1">
                    <span class="absolute inset-0 bg-blue-200 opacity-25 rounded"></span>
                    <span class="relative text-lg text-blue-500"><?php echo $titleOfAddModal; ?></span>
                </div>
                <span class="cursor-pointer hover:text-white hover:bg-gray-600 px-3 py-2 rounded-full" id="close-a-modal"><i class="bi bi-x-lg"></i></span>
            </div>

            <!-- erreur à afficher si la formulaire est mal remplie -->
            <!-- <div class="border-t border-b border-red-500 bg-red-100 text-red-500 text-center p-2" id="m-error">
                <p>Veuillez remplir correctement la formulaire de modification</p>
            </div> -->
            
            <!-- formulaire à completer -->
            <div class="p-4">
                <form action=<?php echo $urlOfAddModal; ?> method="post" id="a-client-form">
                    <div class="flex gap-1 my-2">
                        <div class="flex-1 flex flex-col">
                            <label for="a-client-id">ID</label>
                            <input type="text" class="focus:border-blue-400 focus:bg-white bg-gray-200 hover:bg-white hover:border-gray-300 focus:outline-none pl-1 py-1 border rounded modal-input" id="a-client-id" name="a-client-id" required autocomplete="off">
                        </div>
                        <div class="flex-1 flex flex-col">
                            <label for="a-client-name">Nom</label>
                            <input type="text" class="focus:border-blue-400 focus:bg-white bg-gray-200 hover:bg-white hover:border-gray-300 focus:outline-none pl-1 py-1 border rounded modal-input" id="a-client-name" name="a-client-name" required autocomplete="off">
                        </div>
                    </div>
                    <div class="flex flex-col my-2">
                        <label for="a-client-contact">Contact</label>
                        <input type="text" class="focus:border-blue-400 focus:bg-white bg-gray-200 hover:bg-white hover:border-gray-300 focus:outline-none pl-1 py-1 border rounded modal-input" id="a-client-contact" name="a-client-contact" required autocomplete="off">
                    </div>
                    <div class="flex justify-end gap-3 mt-5 mb-1">
                        <button class="focus:outline-none hover:bg-gray-600 bg-gray-500 text-white p-2 rounded" type="submit">Enregistrer</button>
                        <button class="focus:outline-none hover:bg-gray-600 bg-gray-500 text-white p-2 rounded" type="button" id="cancel-a-btn">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
