<div>

    <div class="content"></div>

    <x-header>Archivos</x-header>

    <div class="grid grid-cols-12 gap-4 w-full lg:w-2/3 mx-auto">

        <div class="bg-white rounded-lg shadow-xl p-4 col-span-3" wire:ignore wire:loading.class.delaylongest="opacity-50">

            <div class="-mx-5 text-gray-700" x-data="fileTree({{ json_encode($this->arbol) }})">

                <ul>

                    <template x-for="(level,i) in levels">

                        <li x-html="renderLevel(level,i)"></li>

                    </template>

                </ul>
            </div>

        </div>

        <div class="col-span-9">

            <div class="overflow-x-auto rounded-lg shadow-xl border-t-2 border-t-gray-500">

                <x-table>

                    <x-slot name="head">

                        <x-table.heading >Archivo</x-table.heading>
                        <x-table.heading >Acciones</x-table.heading>

                    </x-slot>

                    <x-slot name="body">

                        @forelse ($files as $file)

                            <x-table.row wire:loading.class.delaylongest="opacity-50" wire:key="row-{{ $loop->index }}">

                                <x-table.cell>

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">archivo</span>

                                    {{ $file }}

                                </x-table.cell>

                                <x-table.cell>

                                    <a
                                        href="{{ Storage::disk('s3')->temporaryUrl($file, now()->addMinutes(10)) }}"
                                        target="_blank"
                                        class="bg-green-400 hover:shadow-lg text-white text-xs px-3 py-1 rounded-full hover:bg-green-700 focus:outline-green-900 w-auto"
                                    >
                                        Ver archivo
                                    </a>

                                </x-table.cell>

                            </x-table.row>

                        @empty

                            <x-table.row>

                                <x-table.cell colspan="10">

                                    <div class="bg-white text-gray-500 text-center p-5 rounded-full text-lg">

                                        No hay resultados.

                                    </div>

                                </x-table.cell>

                            </x-table.row>

                        @endforelse

                    </x-slot>

                    <x-slot name="tfoot">

                        <x-table.row>

                            <x-table.cell colspan="10" class="bg-gray-50">


                            </x-table.cell>

                        </x-table.row>

                    </x-slot>

                </x-table>

            </div>

        </div>

    </div>

    <script >

        function transformarArreglo(a) {

            const transformar = (obj) => {

                return Object.keys(obj).map((key) => {

                    let item = {
                        title: key,
                        children: []
                    };

                    if (typeof obj[key] === 'object') {
                        item.children = transformar(obj[key]);
                    }

                    return item;

                });

            };

            return transformar(a);

        }

        function fileTree(arbol) {

            return {
                levels: transformarArreglo(arbol),
                renderLevel: function(obj,i){

                    let ref = 'l' + Math.random().toString(36).substring(7);

                    let refA = 'a' + Math.random().toString(36).substring(7);

                    let html = `
                                <a
                                    data-name="${obj.title}"
                                    href="#"
                                    x-ref="${refA}"
                                    class="block px-5 py-1 hover:text-gray-900 flex items-center gap-2 carpeta"
                                    :class="{ 'has-children' : level.children }"
                                    x-html="
                                            (
                                                level.children ? '<i class=\\'mdi mdi-folder-outline text-orange-500\\'><svg  fill=\\'none\\' viewBox=\\'0 0 24 24\\' stroke-width=\\'1.5\\' stroke=\\'currentColor\\' class=\\'size-4\\'><path stroke-linecap=\\'round\\' stroke-linejoin=\\'round\\' d=\\'M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z\\' /></svg></i>'
                                                               : '<i class=\\'mdi mdi-file-outline text-gray-600\\'><svg xmlns=\\'http://www.w3.org/2000/svg\\' fill=\\'none\\' viewBox=\\'0 0 24 24\\' stroke-width=\\'1.5\\' stroke=\\'currentColor\\' class=\\'size-4\\'><path stroke-linecap=\\'round\\' stroke-linejoin=\\'round\\' d=\\'M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z\\' /></svg></i>'
                                            ) + ' ' + level.title;
                                           "
                                    ${obj.children.length > 0 ? `@click.prevent="toggleLevel($refs.${ref})"` : `@click.prevent="viewFiles($refs.${refA})"`}
                                >
                                </a>`;


                    if(obj.children) {

                        html += `<ul
                                    style="display:none;"
                                    x-ref="${ref}"
                                    class="pl-5 pb-1 transition-all duration-1000 opacity-0">

                                        <template x-for='(level,i) in level.children'>
                                            <li x-html="renderLevel(level,i)"></li>
                                        </template>

                                </ul>`;
                    }

                    return html;

                },
                showLevel: function(el) {

                    if (el.style.length === 1 && el.style.display === 'none') {

                        el.removeAttribute('style')

                    } else {

                        el.style.removeProperty('display')

                    }

                    setTimeout(()=>{

                        el.previousElementSibling.querySelector('i.mdi').classList.add("mdi-folder-open-outline");
                        el.previousElementSibling.querySelector('i.mdi').classList.remove("mdi-folder-outline");
                        el.classList.add("opacity-100");

                    },10)

                },
                hideLevel: function(el) {

                    el.style.display = 'none';
                    el.classList.remove("opacity-100");
                    el.previousElementSibling.querySelector('i.mdi').classList.remove("mdi-folder-open-outline");
                    el.previousElementSibling.querySelector('i.mdi').classList.add("mdi-folder-outline");

                    let refs = el.querySelectorAll('ul[x-ref]');

                    for (var i = 0; i < refs.length; i++) {

                        this.hideLevel(refs[i]);

                    }

                },
                toggleLevel: function(el) {

                    if( el.style.length && el.style.display === 'none' ) {

                        this.showLevel(el);

                    } else {

                        this.hideLevel(el);

                    }

                },
                viewFiles: function(el) {

                    window.scrollTo(0, 0)

                    let node = el

                    let ruta = el.getAttribute('data-name')

                    node = node.parentNode

                    while(node.getAttribute("x-data") == null){

                        node = node.parentNode

                        if(node.tagName == 'LI'){

                            ruta = node.getElementsByTagName('a')[0].getAttribute("data-name") + '/' + ruta

                        }

                    }

                    @this.mostrarArchivos(ruta)

                    const content = document.querySelector('.content')

                    console.log(content)

                    content.scrollIntoView({ behavior: "smooth", block: "end", inline: "nearest" });

                }

            }

        }

    </script>

</div>
