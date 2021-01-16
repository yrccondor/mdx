import "./style.scss";
import "./editor.scss";
import { TextControl, TextareaControl, CheckboxControl } from "@wordpress/components";

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;

registerBlockType("mdx/fold", {
    title: __("MDx 折叠内容", "mdx"),
    icon: "editor-contract",
    category: "common",
    keywords: ["mdx", __("折叠内容", "mdx")],
    attributes: {
        title: {
            type: "string",
            default: __("被折叠内容", "mdx")
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
            <div
                className={className}
                style={{
                    padding: "20px",
                    boxSizing: "border-box",
                    backgroundColor: "#F4F4F4",
                    borderRadius: "3px"
                }}
            >
                <TextControl
                    label={__("标题", "mdx")}
                    value={attributes.title}
                    onChange={val => {
                        setAttributes({ title: val });
                    }}
                />
                <TextareaControl
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
    keywords: ["mdx", __("警告内容", "mdx")],
    attributes: {
        title: {
            type: "string",
            default: __("警告", "mdx")
        },
        content: {
            type: "string"
        }
    },
    edit: ({ attributes, setAttributes, className }) => {
        return (
            <div
                className={className}
                style={{
                    paddingLeft: "20px",
                    boxSizing: "border-box",
                    borderLeft: "4px solid #c80000"
                }}
            >
                <TextControl
                    label={__("标题", "mdx")}
                    value={attributes.title}
                    onChange={val => {
                        setAttributes({ title: val });
                    }}
                />
                <TextareaControl
                    label={__("警告内容", "mdx")}
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
                    <i className="mdui-icon material-icons">
                        warning
                    </i>
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
    keywords: ["mdx", __("进度指示器", "mdx")],
    attributes: {
        progress: {
            type: "string"
        }
    },
    edit: ({ attributes, setAttributes, className }) => {
        return (
            <div className={className}>
                <TextControl
                    label={__("进度 (0-100)", "mdx")}
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
    icon: <svg viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg">
        <defs><style></style></defs><path d="M950.93 512q0 143.43-83.75 257.97T650.9 928.55q-15.43 2.85-22.6-4.02t-7.17-17.12V786.87q0-55.44-29.7-81.11 32.55-3.44 58.6-10.32t53.68-22.3T750 635.1t30.28-59.98 11.7-86.01q0-69.12-45.13-117.7 21.14-52-4.53-116.58-16.02-5.12-46.3 6.29t-52.6 25.16l-21.72 13.68Q568.54 285.1 512 285.1t-109.71 14.85q-9.15-6.3-24.29-15.43t-47.69-22.02-49.15-7.68q-25.16 64.58-4.02 116.59Q232 419.99 232 489.1q0 48.56 11.7 85.72t30 59.98 46 38.25 53.68 22.3 58.6 10.32q-22.83 20.56-28.02 58.88-12 5.7-25.75 8.56t-32.55 2.85-37.45-12.29T276.48 728q-10.83-18.28-27.72-29.7t-28.3-13.67l-11.42-1.69q-12 0-16.6 2.56t-2.85 6.59 5.12 7.97 7.46 6.88l4.02 2.85q12.58 5.7 24.87 21.72t18 29.11l5.7 13.17q7.46 21.72 25.16 35.1T318.17 826t39.72 4.03 31.74-1.98l13.17-2.27q0 21.73.29 50.84t.3 30.86q0 10.32-7.47 17.12t-22.82 4.02Q240.57 884.6 156.82 770.05T73.07 512.07q0-119.44 58.88-220.3t159.74-159.75T512 73.14t220.3 58.88 159.75 159.75 58.88 220.3z" fill="#000"></path>
    </svg>,
    category: "common",
    keywords: [__("github"), "mdx"],
    attributes: {
        author: {
            type: "string"
        },
        project: {
            type: "string"
        },
        gateway: {
            type: "string",
            default: "https://api.github.com/"
        }
    },
    edit: ({ attributes, setAttributes, className }) => {
        return (
            <div
                className={className}
                style={{
                    padding: "20px",
                    paddingTop: "15px",
                    boxSizing: "border-box",
                    backgroundColor: "#414141",
                    borderRadius: "3px",
                    color: "white"
                }}
            >
                <div style={{
                    marginBottom: "10px"
                }}>
                    <svg
                        style={{
                            opacity: ".5",
                            verticalAlign: "middle",
                            width: "20px",
                            height: "20px",
                            marginRight: "5px"
                        }}
                        viewBox="0 0 1024 1024"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <defs><style></style></defs><path d="M950.93 512q0 143.43-83.75 257.97T650.9 928.55q-15.43 2.85-22.6-4.02t-7.17-17.12V786.87q0-55.44-29.7-81.11 32.55-3.44 58.6-10.32t53.68-22.3T750 635.1t30.28-59.98 11.7-86.01q0-69.12-45.13-117.7 21.14-52-4.53-116.58-16.02-5.12-46.3 6.29t-52.6 25.16l-21.72 13.68Q568.54 285.1 512 285.1t-109.71 14.85q-9.15-6.3-24.29-15.43t-47.69-22.02-49.15-7.68q-25.16 64.58-4.02 116.59Q232 419.99 232 489.1q0 48.56 11.7 85.72t30 59.98 46 38.25 53.68 22.3 58.6 10.32q-22.83 20.56-28.02 58.88-12 5.7-25.75 8.56t-32.55 2.85-37.45-12.29T276.48 728q-10.83-18.28-27.72-29.7t-28.3-13.67l-11.42-1.69q-12 0-16.6 2.56t-2.85 6.59 5.12 7.97 7.46 6.88l4.02 2.85q12.58 5.7 24.87 21.72t18 29.11l5.7 13.17q7.46 21.72 25.16 35.1T318.17 826t39.72 4.03 31.74-1.98l13.17-2.27q0 21.73.29 50.84t.3 30.86q0 10.32-7.47 17.12t-22.82 4.02Q240.57 884.6 156.82 770.05T73.07 512.07q0-119.44 58.88-220.3t159.74-159.75T512 73.14t220.3 58.88 159.75 159.75 58.88 220.3z" fill="#fff"></path>
                    </svg>
                    <span style={{
                        fontSize: "15px",
                        opacity: ".5",
                        verticalAlign: "middle"
                    }}>
                        GitHub
                    </span>
                </div>
                <TextControl
                    style={{
                        backgroundColor: "#414141",
                        color: "white"
                    }}
                    label={__("作者用户名", "mdx")}
                    value={attributes.author}
                    onChange={val => {
                        setAttributes({ author: val });
                    }}
                />
                <TextControl
                    style={{
                        backgroundColor: "#414141",
                        color: "white"
                    }}
                    label={__("仓库名", "mdx")}
                    value={attributes.project}
                    onChange={val => {
                        setAttributes({ project: val });
                    }}
                />
                <TextControl
                    style={{
                        backgroundColor: "#414141",
                        color: "white",
                        opacity: ".7"
                    }}
                    label={__("API 网关", "mdx")}
                    value={attributes.gateway}
                    onChange={val => {
                        setAttributes({ gateway: val });
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
                data-mdxgithubg={attributes.gateway}
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
    keywords: ["mdx", __("文章信息卡", "mdx")],
    attributes: {
        url: {
            type: "string"
        }
    },
    edit: ({ attributes, setAttributes, className }) => {
        return (
            <div
                className={className}
                style={{
                    padding: "20px",
                    paddingTop: "15px",
                    boxSizing: "border-box",
                    backgroundColor: "rgb(250, 250, 250)",
                    borderRadius: "3px",
                    border: "1px solid #e0e0e0"
                }}
            >
                <span style={{
                    fontSize: "15px",
                    marginBottom: "20px",
                    opacity: ".5"
                }}>
                    {__("文章信息卡", "mdx")}
                </span>
                <TextControl
                    label={__("URL", "mdx")}
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
    keywords: ["mdx", __("广告", "mdx")],
    edit: () => {
        return (
            <div style={{
                textAlign: "center",
                lineHeight: "150px",
                backgroundColor: "rgb(240, 240, 240)",
                color: "rgba(0, 0, 0, .25)"
            }}>
                AD
            </div>
        );
    },
    save: () => {
        return "[mdx_ad][/mdx_ad]";
    }
});
