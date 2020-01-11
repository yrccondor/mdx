import "./style.scss";
import "./editor.scss";
import { TextControl, CheckboxControl } from "@wordpress/components";

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;

registerBlockType("mdx/fold", {
    title: __("MDx 折叠内容", "mdx"),
    icon: "editor-contract",
    category: "common",
    keywords: [__("fold"), __("mdx"), __("折叠内容")],
    attributes: {
        title: {
            type: "string"
        },
        content: {
            type: "string"
        },
        isOpen: {
            type: "boolean"
        }
    },
    edit: ({ attributes, setAttributes, className }) => {
        return (
            <div className={className}>
                <TextControl
                    label={__("内容标题", "mdx")}
                    value={attributes.title}
                    onChange={val => {
                        setAttributes({ title: val });
                    }}
                />
                <TextControl
                    label={__("折叠内容", "mdx")}
                    value={attributes.content}
                    onChange={val => {
                        setAttributes({ content: val });
                    }}
                />
                <CheckboxControl
                    label={__("默认打开", "mdx")}
                    checked={attributes.isOpen}
                    onChange={val => {
                        setAttributes({ isOpen: val });
                    }}
                />
            </div>
        );
    },
    save: ({ attributes }) => {
        return (
            <div className="mdui-panel mdui-panel-gapless">
                <div
                    className={
                        "mdui-panel-item" +
                        (attributes.isOpen ? " mdui-panel-item-open" : "")
                    }
                >
                    <div className="mdui-panel-item-header">
                        <div className="mdui-panel-item-title">
                            {attributes.title}
                        </div>
                        <i className="mdui-panel-item-arrow mdui-icon material-icons">
                            keyboard_arrow_down
                        </i>
                    </div>
                    <div className="mdui-panel-item-body">
                        <p>{attributes.content}</p>
                    </div>
                </div>
            </div>
        );
    }
});

registerBlockType("mdx/warning", {
    title: __("MDx 警告内容", "mdx"),
    icon: "warning",
    category: "common",
    keywords: [__("warning"), __("mdx"), __("警告内容")],
    attributes: {
        title: {
            type: "string"
        },
        content: {
            type: "string"
        }
    },
    edit: ({ attributes, setAttributes, className }) => {
        return (
            <div className={className}>
                <TextControl
                    label={__("内容标题", "mdx")}
                    value={attributes.title}
                    onChange={val => {
                        setAttributes({ title: val });
                    }}
                />
                <TextControl
                    label={__("折叠内容", "mdx")}
                    value={attributes.content}
                    onChange={val => {
                        setAttributes({ content: val });
                    }}
                />
            </div>
        );
    },
    save: ({ attributes }) => {
        return (
            <blockquote className="mdx-warning">
                <p>
                    <i className="mdui-icon material-icons"></i>
                    {" " + attributes.title}
                    <br />
                    <strong>{attributes.content}</strong>
                </p>
            </blockquote>
        );
    }
});

registerBlockType("mdx/progress", {
    title: __("MDx 进度指示器", "mdx"),
    icon: "minus",
    category: "common",
    keywords: [__("progress"), __("mdx"), __("进度指示器")],
    attributes: {
        progress: {
            type: "string"
        }
    },
    edit: ({ attributes, setAttributes, className }) => {
        return (
            <div className={className}>
                <TextControl
                    label={__("进度(0-100)", "mdx")}
                    value={attributes.progress}
                    onChange={val => {
                        setAttributes({ progress: val });
                    }}
                />
            </div>
        );
    },
    save: ({ attributes }) => {
        return (
            <div className="mdui-progress">
                <div
                    className="mdui-progress-determinate"
                    style={{ width: attributes.progress + "%" }}
                ></div>
            </div>
        );
    }
});

registerBlockType("mdx/github", {
    title: __("MDx Github 信息卡", "mdx"),
    icon: "networking",
    category: "common",
    keywords: [__("github"), __("mdx"), __("github")],
    attributes: {
        author: {
            type: "string"
        },
        project: {
            type: "string"
        }
    },
    edit: ({ attributes, setAttributes, className }) => {
        return (
            <div className={className}>
                <TextControl
                    label={__("项目作者的用户名", "mdx")}
                    value={attributes.author}
                    onChange={val => {
                        setAttributes({ author: val });
                    }}
                />
                <TextControl
                    label={__("仓库名称", "mdx")}
                    value={attributes.project}
                    onChange={val => {
                        setAttributes({ project: val });
                    }}
                />
            </div>
        );
    },
    save: ({ attributes }) => {
        return (
            <div
                className="mdx-github-cot"
                data-mdxgithuba={attributes.author}
                data-mdxgithubp={attributes.project}
            >
                <div className="mdx-github-wait-out-c2">
                    <div className="mdx-github-wait-out-c mdui-valign">
                        <div className="mdx-github-wait-out">
                            <div className="mdx-github-wait">
                                <a
                                    href={
                                        "https://github.com/" +
                                        attributes.author +
                                        "/" +
                                        attributes.project
                                    }
                                >
                                    <div className="mdui-spinner"></div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
});

registerBlockType("mdx/post", {
    title: __("MDx 文章信息卡", "mdx"),
    icon: "format-aside",
    category: "common",
    keywords: [__("post"), __("mdx"), __("文章信息卡")],
    attributes: {
        url: {
            type: "string"
        }
    },
    edit: ({ attributes, setAttributes, className }) => {
        return (
            <div className={className}>
                <TextControl
                    label={__("URL 内容", "mdx")}
                    value={attributes.url}
                    onChange={val => {
                        setAttributes({ url: val });
                    }}
                />
            </div>
        );
    },
    save: ({ attributes }) => {
        return (
            <div className="mdx-post-cot" data-mdxposturl={attributes.url}>
                <div className="mdx-post-wait-out-c2">
                    <div className="mdx-post-wait-out-c mdui-valign">
                        <div className="mdx-github-wait-out">
                            <div className="mdx-github-wait">
                                <a href={attributes.url}>
                                    <div className="mdui-spinner"></div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
});

registerBlockType("mdx/ad", {
    title: __("MDx 广告", "mdx"),
    icon: "media-document",
    category: "common",
    keywords: [__("ad", "mdx", "广告")],
    edit: () => {
        return <div>MDx 广告</div>;
    },
    save: () => {
        return "[mdx_ad][/mdx_ad]";
    }
});
