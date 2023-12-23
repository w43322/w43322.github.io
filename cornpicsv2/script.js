function updkw(keyword) {
    document.getElementById("keyword").value = keyword;
    document.getElementById("current_page").value = 1;
    document.getElementById("option").value = 0;
    upd();
}

function upd() {
    const config = JSON.parse(document.getElementById("config").value);
    const keyword = document.getElementById("keyword").value;
    const current_page = document.getElementById("current_page").value;
    const option = document.getElementById("option").value;
    const galleries = config.url_template.replace("%k", keyword).replace("%o", config.option[option]).replace("%p", config.pagination.start + config.pagination.step * (current_page - 1));
    //console.log(galleries);
    
    const galleries_pattern = config.galleries_pattern;
    const images_pattern = config.images_pattern;
    const title_pattern = config.title_pattern;

    const rows = document.getElementById("rows");
    rows.textContent = "";
    fetch(galleries).then(response => response.text()).then(text => {
        const matches = text.matchAll(galleries_pattern);
        for (const match of matches) {
            const row = document.createElement("div");
            row.setAttribute("class", "row");
            rows.appendChild(row);
            const gallery = match[1];
            fetch(gallery).then(response => response.text()).then(text => {
                //console.log(text);
                const title = document.createElement("div");
                title.setAttribute("class", "title");
                title.textContent = text.match(title_pattern)[1];
                row.appendChild(title);

                const images = document.createElement("div");
                images.setAttribute("class", "images");
                row.appendChild(images);
                const matches = text.matchAll(images_pattern);
                for (const match of matches) {
                    const image = document.createElement("img");
                    image.setAttribute("class", "image");
                    image.setAttribute("src", match[1]);
                    image.setAttribute("alt", "");
                    images.appendChild(image);
                }

                const tag_groups = document.createElement("div");
                tag_groups.setAttribute("class", "tag_groups");
                row.appendChild(tag_groups);
                for (const key in config.tag_groups) {
                    const tag_group = document.createElement("div");
                    tag_group.setAttribute("class", "tag_group");
                    const tag_group_name = document.createElement("div");
                    tag_group_name.setAttribute("class", "tag_group_name");
                    tag_group_name.textContent = key;
                    tag_group.appendChild(tag_group_name);
                    const tags = document.createElement("div");
                    tags.setAttribute("class", "tags");
                    tag_group.appendChild(tags);
                    for (const match of text.matchAll(config.tag_groups[key])) {
                        const tag_text = match[1];
                        const tag = document.createElement("button");
                        tag.setAttribute("type", "button");
                        tag.setAttribute("class", "tag");
                        tag.setAttribute("onclick", `updkw("${tag_text}")`);
                        tag.textContent = tag_text;
                        tags.appendChild(tag);
                    }
                    if (tags.hasChildNodes()) {
                        tag_groups.appendChild(tag_group);
                    }
                }
            });
        }
    });
}
