<div class="fixed z-10 inset-0 justify-center items-center overflow-y-auto hidden" id="del-modal">
    <!-- effet de transparence -->
    <div class="absolute inset-0 bg-black opacity-50"></div>

    <!-- fenêtre modal -->
    <div class="absolute bg-white overflow-hidden shadow-xl transform transition-all sm:w-full sm:mx-auto max-w-sm text-gray-600 rounded">
        <!-- titre et bouton fermé -->
        <div class="flex justify-between p-3">
            <div class="relative block px-2 py-1">
                <span class="absolute inset-0 bg-blue-200 opacity-25 rounded"></span>
                <span class="relative text-lg text-blue-500"><?php echo $titleOfDeleteModal; ?></span>
            </div>
            <span class="cursor-pointer hover:text-white hover:bg-gray-600 px-3 py-2 rounded-full" id="close-del-modal"><i class="bi bi-x-lg"></i></span>
        </div>

        <!-- formulaire à envoyer au server -->
        <div class="p-4">
            <form action=<?php echo $urlOfDeleteModal; ?> method="post" id="del-form">
                <div class="">
                    <span id="del-id-text"></span>
                    <input type="text" class="w-fit focus:outline-none border-none cursor-default" id="del-id" name="del-id" hidden readonly>
                </div>
                <div class="flex justify-end gap-3 mt-5 mb-1">
                    <button class="focus:outline-none hover:bg-gray-600 bg-gray-500 text-white p-2 rounded" type="submit">Supprimer</button>
                    <button class="focus:outline-none hover:bg-gray-600 bg-gray-500 text-white p-2 rounded" type="button" id="cancel-del-btn">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>